
 <?php

   $entityManager=new CarreManager();

    if( isset($_POST['btn_submit'])){

        if($_POST['btn_submit']==="calcul"){

        $validator=new Validator();

        $longueur=$_POST['longueur'];
      
          $validator->is_empty($longueur,'longueur');
         if($validator->is_valid()){
                   $validator->is_positif( $longueur,'longueur');
                   if($validator->is_valid()){
                      $carre=new Carre();
                      $carre->setLongueur($longueur);
                      $entityManager->create($carre);
                   }
           
         }
         $errors=$validator->getErrors();

            if(isset($errors['longueur'])){
                $longueur="";
            }

        }else{
            session_destroy();
        }
    }


 ?>



         <div class="container mt-5">

        
             <form method="post" action="">
                 <div class="form-group row">
                     <label for="inputName" class="col-sm-1-12 col-form-label">Longueur</label>
                     <div class="col-6 ml-2">
                         <input type="text" class="form-control" name="longueur" value="<?=$longueur?>" id="inputName" placeholder="">
                     </div>
            <?php if(isset($errors['longueur'])){


            ?>
                     <div class="alert alert-danger col-4">
                         <strong>Erreur</strong> <?php echo $errors['longueur'];?>
                     </div>
             <?php
            }
            ?>

                 </div>
                 

                 <div class="form-group row">
                     <div class="offset-sm-2 col-sm-2">
                         <button type="submit" name="btn_submit" value="calcul" class="btn btn-primary">Calculer</button>
                     </div>
                     <div class="col-sm-2">
                         <button type="submit" name="btn_submit" value="reinitialisation" class="btn btn-secondary">Reinitialiser</button>
                     </div>
                 </div>
             </form>
         </div>
<?php
    $carres=$entityManager->findAll();
  
      if(count($carres)>0 ) {
?>
        <table class="table container table-bordered">
            <thead>
                <tr>
                    <th>Demi-Perimetre</th>
                    <th>Perimetre</th>
                    <th>Surface</th>
                    <th>Diagonale</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($carres as $key=> $carre) {
                   
            ?>
                <tr>
                    <td scope="row"><?=$carre->demiPerimetre()?></td>
                    <td><?=$carre->perimetre()?></td>
                    <td><?=$carre->surface()?></td>
                    <td><?=$carre->diagonale()?></td>
                    <td>
                    <a name="" id="" class="btn btn-success" href="#" role="button">Edit</a>
                    <a name="" id="" class="btn btn-danger" href="index.php?id=<?=$carre->getId() ?>" role="button">Delete</a>
                    </td>
                </tr>

                <?php
              
                }
                ?>

            </tbody>
        </table>

    <?php
       }
 ?>


<?php
    if(isset($_GET['id'])){
        ?>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Alert</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Voulez-vous supprimer ?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a id="" class="btn btn-success" href="index.php?ok=1" role="button" data-dismiss="modal">Oui</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        </div>

<?php   
    if (isset($_GET['ok'])) {
        $id=$_GET['id'];
        $entityManager->delete($id);

        
    }
    }
?>