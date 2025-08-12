
<div class="container mt-5">
<div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style=" background: hsl(252, 75%, 60%);">
                <h5 class="modal-title">MODIFIER INFORMATION DU GROUPE</h5>
            </div>
            <div class="modal-body">
                <form  method="POST" id="modifierInfoGroupe">
                    <div class="mb-3">
                        <label class="form-label required">NOM GROUPE</label>
                        <input type="text" class="form-control" name="nom" value="<?=$groupe['nom_groupe']?>" required>
                    </div>
                    
                    <input type="text" class="form-control" name="id_groupe" value="<?=$id_groupe?>" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label required">PHOTO DE PROFIL</label>
                        <input type="file"  name="photo" class="form-control" value="<?=$groupe['photo_groupe']?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              
                <button type="submit" class="btn btn-primary btn-sm  status" form="modifierInfoGroupe">Modifier</button>
                <button type="submit" class="btn btn-danger btn-close" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
