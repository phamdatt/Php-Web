<?php 
$slider = loadModel('slider');
$category = loadModel('category');


$list_category = $category->category_list(['parentid' => 0, 'status' => 1, 'order' =>['orders', 'ASC']]);


$list_silder = $slider->slider_list(['status'=>1,'position'=>'slideshow']);
?>
<section class=" clearfix slider">
			<div class="container">
				<div class="row">
          <div class="col-sm-4">
            <div id="h1">
              <ul>
              <?php  foreach($list_category as $row_cat1):?>
                <?php
                $list_category2 = $category->category_list(['parentid' => $row_cat1['id'],'status' => 1]);
            ?>
                <li>
                  <a href="index.php?option=product&cat=<?php echo $row_cat1['slug'];?>"><?php echo $row_cat1['name'];?></a>
                  <?php if (count($list_category2) > 0) : ?>
                  <ul class="sub-menu">
                  <?php foreach ($list_category2 as $row_cat2) : ?>
                    <li><a href="index.php?option=product&cat=<?php echo $row_cat2['slug'];?>"><?php echo $row_cat2['name'];?></a></li>
                    
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
              </li>
                
              <?php endforeach;?>
              </ul>
            </div>
      					</div>
					<div class="col-sm-8">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
  <?php $index = 0;?>
  <?php foreach ($list_silder as $row_slider):?>
  <?php if($index == 0): ?>
    <div class="carousel-item active">
      <img src="public/images/<?php echo $row_slider['img']; ?>" class="d-block w-100" alt="..." height="500px">
      </div>
  <?php else: ?>
    <div class="carousel-item">
      <img src="public/images/<?php echo $row_slider['img']; ?>" class="d-block w-100" alt="..." height="500px">
      </div>
  <?php  endif;?>
  
    
      <?php $index++;?>
  <?php  endforeach;?>
    </div>
    <div class="carousel-item">
      <img src="public/images/hinh2.png" class="d-block w-100" alt="..." height="500px">	
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="public/images/hinh3.png" class="d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
	</div>
	</div>
  </div>
</div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
			
		</section>




