<?= $header ?>
<main>
<div >
    <form action="registerStatutService" method="POST">
        <div class="titre">Statut</div>

        <fieldset>
            <legend><span class="nombre">#</span> Informations</legend>
            <label><span class="intitule">Statut *</span></label>
            <select name="selectStatut" id="selectStatut">
                <option value="1">Administrateur</option> 
                <option value="2" >Moderateur</option>
                <option value="3" selected>Abonné</option>
            </select>

            

            <label><span class="intitule">ID *</span></label>
            <input type="text" name="id" id="id" >
            <div id="errormail" class="errors">
                 <?php  if(!empty($registerStatutService)) {if (empty($registerStatutService["id"])==false){echo $registerStatutService["id"];}}?>
            </div>
     

        </fieldset>

             <input type="submit" value="Envoyer" tabindex="3"/>
    </form>
</div>
</main>
<!-- <script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script> -->

<?= $footer ?>

