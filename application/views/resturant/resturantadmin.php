<main class="">
   <h1 style="margin-top:1em; text-align: center;">Welcome Owner!</h1>
   <h3 style="margin-top:1em; text-align: center;">Please add menu item below </h3>
   <?php if (strlen($status) > 0): echo '<div class="alert bg-not">' . $status . '</div>'; endif?>
   <?php if(isset($_SESSION['name']) and $_SESSION['name']=='admin'){ ?>
   <?php ?>
      <form action="<?php echo base_url();?>resturant/addmenu" method="POST" style="margin-bottom: 3rem; margin-top:1em; text-align: center;" enctype="multipart/form-data">
         <div class="container">
         <div class="row">	
         <div class="col-sm" style="margin-bottom: 3rem;">
            <div class="col-sm-6">
               <div class="card text-center " style="width: 20rem; height:25rem; box-shadow: 5px 5px #d3d3d3;">
                  <input class="card-header bg-four text-white" id="name" type="text" placeholder="please enter dish name" name="name"  required>
                  <h6>Select an image for uplaod</h6>
                  
                  <div class="card-body">
                     <input type='file' name='userfile' size='20' />
                     <input class="card-title" id="details" type="text" placeholder="details please" name="details"  required>
                     <input class="card-text" id="name" type="text" placeholder="category" name="category"  required>
                  </div>
                  <div class="card-footer bg-transparent bg-primary text-black">
                     <input class="card-text" id="price" type="text" placeholder="please enter price" name="price"  required>
                     <input type="submit" class="btn bg-four btn-search" name="addMenu" value="ADD">
                  </div>
               </div>
            </div>
         </div>
         <div style="margin:2rem; ">
            <img class="card-img-top" style="width:35rem; height:20rem; box-shadow:20px 20px 50px 15px #D1D1D1; border-radius: 3em 7em;" src="<?php echo base_url();?>profilePic/resturantOne.jpg">
         </div>
         </div>
      </div>
      </form>
      <?php ?>
   <?php } ?>

   <div class="container">
      <div class="row">	
      <?php if($menu) : foreach($menu as $new) { ?>
         <div class="col-sm" style="margin-bottom: 3rem;">
            <div class="col-sm-6">
               <div class="card text-center " style="width: 20rem; height:25rem; box-shadow: 8px 8px #d3d3d3;">
                  <div class="card-header bg-four text-white" ">Name :<?php echo $new->name;?></div><br>
                  <img class="card-img-top" style="width:300px; height:150px;" src="<?php echo base_url();?>profilePic/<?php echo $new->filename; ?>" alt="Food Image">
                  <div class="card-body">
                     <h5 class="card-title">Details :<?php echo $new->details;?></h5>
                     <p class="card-text">category :<?php echo $new->category;?></p>
                     <a href="" class="btn bg-link" >$ <?php echo $new->price;?></a>
                     <!-- <a href="" class="btn btn-primary">Visit Resturant</a> -->
                  </div>
                  <div class="card-footer bg-transparent bg-primary text-black">
                     <!-- <a href="" class="btn bg-link" >$ </a> -->
                  </div>
               </div>
            </div>
         </div>
      <?php }  endif?>
         
      </div>
   </div>
</main>