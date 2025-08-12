'use strict';

let callBtn = $("#callBtn");
let callBox = $("#callBox");
let answerBtn = $("#answerBtn");
let declineBtn = $("#declineBtn");

let pc;
let sendTo = callBtn.data('user');
let localStream; //flux de la camera
//LES ELEMENTS DE LA VIDEO
const localVideo =document.querySelector("#localVideo");
const remoteVideo = document.querySelector("#remoteVideo");

//les infos du media
const mediaConst = {
 video:true
};

//LES INFORMATION RECU 
const options = {
    offerToReceiveVideo: 1,
};


function getConn(){

    if(!pc){
        pc = new RTCPeerConnection();
    }

}

//DEMANDE D`ACCES AU MEDIA

async function getCam(){

    let mediaStream;

 try{

    if(!pc){
      await  getConn();
    }

  mediaStream = await navigator.mediaDevices.getUserMedia(mediaConst);
 localVideo.srcObject = mediaStream;
 
 localStream = mediaStream;
 localStream.getTracks().forEach( track => pc.addTrack(track, localStream));
 localVideo.play();
}catch(error){
    console.log(error);
 }

}

// fin media

async function createOffer(sendTo){

    await sendIceCandidate(sendTo);

    await pc.createOffer(options); // generer le SDP

    await pc.setLocalDescription(pc.localDescription);
      send('client-offer', pc.localDescription, sendTo);

    }

    //fin


    async function createAnswer(sendTo, data){
        if(!pc){
           await getConn();
         }
         if(!localStream){
             await getCam();
         }


         await sendIceCandidate(sendTo);
         await pc.setRemoteDescription(data);
         await pc.createAnswer();
         await pc.setLocalDescription(pc.localDescription);
         send('client-answer', pc.localDescription, sendTo);
       
       
        }


function sendIceCandidate(sendTo){

    pc.onicecandidate = e =>{

        if(e.candidate !== null){
            // envoi des donnes au deuxieme candidat
          send('client-candidate', e.candidate, sendTo);
        }
    }

    pc.ontrack = e =>{
        var camera1 = document.getElementById("video");
        camera1.classList.remove("hidden");
        // $('#profile').addClasse('hidden');
       remoteVideo.srcObject = e.streams[0];
       remoteVideo.play();
      
    }

}


function hangup(){
    send('client-hangup', null, sendTo);
    pc.close();
    pc = null;
}

$('#hangupBtn').on('click' , () =>{
   hangup();
   location.reload(true);

});



$('#callBtn').on('click' , () =>{
    getCam();
    send('is-client-ready', null, sendTo);

});

conn.onopen = e =>{
    console.log('connected to websocket');
}

conn.onmessage = async e =>{

    let message = JSON.parse(e.data);
    let by      = message.by;
    let data     = message.data;
    let type      = message.type;
    let profileImage = message.profileImage;
    let username = message.username;

   $('#username').text(username);
   $('#profileImage').attr('src', profileImage);

    switch(type){

     case 'client-candidate':

     if(pc.localDescription){
        await pc.addIceCandidate(new RTCIceCandidate(data));
     }
    break;




     case 'is-client-ready': 

    if(!pc){
        await getConn();
    }

     if(pc.iceConnectionState === "connected"){
        send('client-already-oncall');
        
     }else{
        //popup
        displayCall();

        answerBtn.on('click', () =>{

       var element = document.getElementById("callBox");
        element.classList.add("hidden");

       var elements = document.getElementById("wrapper");
         elements.classList.remove("flou");
         send('client-is-ready', null, sendTo);

        });



        declineBtn.on('click', () =>{
            send('client-rejected', null, sendTo);
            location.reload(true);
        });
      
     }
        break;

        case 'client-answer':
     
            if(pc.localDescription){
                 await pc.setRemoteDescription(data);
              
                }
            break; 


        case 'client-offer':
            createAnswer(sendTo, data);
            break;


        case 'client-is-ready':
             createOffer(sendTo);
            break; 

        case 'client-already-oncall':
            setTimeout('window.location.reload(true)', 2000);
            break;

         case 'client-rejected':
            //popup
            alert('appel Refuse');
            break; 

            case 'client-hangup':
                //popup
                alert('appel coupe');
                setTimeout('window.location.reload(true)', 2000);
                break; 

   }



}

function send(type, data,sendTo ){
   
        conn.send(JSON.stringify({
            sendTo:sendTo,
            type:type,
            data:data
      }));
    

}


function  displayCall(){

   // callBox.remove('hidden');
    var element = document.getElementById("callBox");
    element.classList.remove("hidden");


    var elements = document.getElementById("wrapper");
    elements.classList.add("flou");
   

}