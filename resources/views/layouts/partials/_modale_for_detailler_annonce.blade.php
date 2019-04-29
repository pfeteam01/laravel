<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Les infos sur l'annonce.</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <span class="typebien"></span><br>
                <span class="typeaction"></span><br>
                <span class="description"></span><br>
                <button type="button" id="commander" class="btn btn-info">Commander</button><br>
                <form method="post" id="commanderAnnonce">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" id="mail" class="form-control" placeholder="Entrer votre email" />
                        <div class="invalid-feedback">That didn't work.</div>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="tel" class="form-control" placeholder="Entrer votre telephone" />
                        <div class="invalid-feedback">That didn't work.</div>
                    </div>
                    <div class="form-group">
                        <textarea id="message" class="form-control" placeholder="Message"></textarea>
                        <div class="invalid-feedback">That didn't work.</div>
                    </div>
                    <input type="submit" value="Envoyer">
                </form>
                <button id="favoris" type="button" class="btn btn-light"><span class="addremove"></span></button><br>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
