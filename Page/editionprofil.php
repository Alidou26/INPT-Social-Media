<div class="container mt-5">
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style=" background: hsl(252, 75%, 60%);">
                        <h5 class="modal-title">Edition de Profil</h5>
                    </div>
                    <div class="modal-body">
                        <form  method="POST" id="editer-profil">
                            <div class="mb-3">
                                <label class="form-label required">NOM</label>
                                <input type="text" class="form-control" name="nom" value="<?=$_SESSION['nom'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">PRENOM</label>
                                <input type="text" class="form-control" name="prenom" value="<?=$_SESSION['prenom'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">MOT DE PASSE</label>
                                <input type="password" name="mot_de_passe" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PHOTO DE PROFIL</label>
                                <input type="file"  name="photo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">DECRIVEZ-VOUS</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      
                        <button type="submit" class="btn btn-primary btn-sm  status" form="editer-profil">Enregistrer</button>
                        <button type="submit" class="btn btn-danger btn-close" data-bs-dismiss="modal">Retour</button>
                    </div>
                </div>
            </div>
        </div>
    </div>