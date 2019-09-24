<main class="">
   <h1 style="margin:1em; text-align: center;">Welcome to Resturant One</h1>
  <form method="GET" action="<?php echo base_url();?>resturant/searchedItem" style="display: flex; flex-direction: row; ">
    <input class="form-control search-style" type="text" id="search" name="keyword" placeholder="search for food…" >
    <input type="submit" class="btn bg-four btn-search" role="button" value="Search">
  </form>
   <div class="container" style="margin-top: 5rem;">
      <div class="row">
      <?php if($menu) : foreach($menu as $new) { ?>
         <div class="col-sm" style="margin-bottom: 3rem;">
            <div class="col-sm-6">
               <div class="card text-center " style="width: 20rem; height:30rem; box-shadow: 8px 8px #d3d3d3 ;">
                  <div class="card-header bg-four" style="box-shadow: 0px; ">Name :<?php echo $new->name;?></div><br>
                  <img class="card-img-top" style="width:20rem; height:150px;" src="<?php echo base_url();?>profilePic/<?php echo $new->filename; ?>" alt="Card image cap">
                  <div class="card-body">
                     <h5 class="card-title">Details :<?php echo $new->details;?></h5>
                     <p class="card-text">category :<?php echo $new->category;?></p>
                     <p class="btn  card-text" >$ <?php echo $new->price;?></p>
                     <!-- <a href="" class="btn btn-primary">Visit Resturant</a> -->
                  </div>
                  <div class="card-footer bg-transparent bg-primary text-black">
                  <a href="<?php echo base_url();?>payment/loadpage?name=<?php echo $new->name;?>&details=<?php echo $new->details;?>&category=<?php echo $new->category;?>&price=<?php echo $new->price;?>&filename=<?php echo $new->filename;?>" class="btn bg-link" >BUY</a>
                     <!-- <a href="" class="btn bg-link" >$ </a> -->
                  </div>
               </div>
            </div>
         </div>
      <?php }  endif?>
      
      <?php if($menu == 0){ ?>
            <div class="col-sm" style="margin-bottom: 3rem;">
               <div class="col-sm-6">
                  <div class="card text-center" style="width: 20rem; height:25rem; box-shadow: 10px 10px #D3D3D3;">
                     <div class="card-header bg-success text-white">Name</div><br>
                     <img class="card-img-top" width="330" src="" alt="Image not available" /><br/>
                     <div class="card-body">
                        <h5 class="card-title">User rating</h5>
                        <p class="card-text">Address</p>
                        <a href="" class="btn btn-primary">Visit Resturant</a>
                     </div>
                  </div>
               </div>
            </div>
      <?php }?>
      </div>
   </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script >
 $(document).ready(function(){  

$('#search').keyup(function(){
    // $("input").css("background-color", "pink");
  });
   $('#search').blur(function(){
     var search = $(this).val();
     // alert(search+"fixed the problem with on type stop");
     $.ajax({
      url:'<?php echo site_url('')?>',
      method:"GET",
      data:{search:search},
      success:function(html)
      {
      //   $('#searched').html(html);
      //how to convert return object into html
      },
      error: function(jqxhr, status, exception) {
            // alert('Exception:', exception);
            //result not found
         }
     })

  });
});
</script>