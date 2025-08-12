
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style=" background: hsl(252, 75%, 60%);">
                        <h5 class="modal-title">CREE UN GROUPE</h5>
                    </div>
                    <div class="modal-body">
                        <form  method="POST" id="groupe">
                            <div class="mb-3">
                                <label class="form-label required">NOM GROUPE</label>
                                <input type="text" class="form-control" name="nom">
                            </div>
                            
                           
                            <div class="mb-3">
                                <label class="form-label required">PHOTO DE PROFIL</label>
                                <input type="file"  name="photo" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      
                        <button type="submit" class="btn btn-primary btn-sm  status" form="groupe">Creer groupe</button>
                        <button type="submit" class="btn btn-danger btn-close" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

