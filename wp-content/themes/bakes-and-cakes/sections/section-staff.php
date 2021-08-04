<?php 

    $staff_section_cat  = get_theme_mod('bakes_and_cakes_staff_section_cat');
    $staff_page         = get_theme_mod('bakes_and_cakes_staff_page');
    
    echo '<div class="container">';
    if($staff_page){
        $page_qry = new WP_Query(array(   
		   'post_type' => 'page',
	       'p' => $staff_page,
		));
			
		if($page_qry->have_posts()){
		    while($page_qry->have_posts()){ $page_qry->the_post(); 
				echo '<header class="header">';
				  echo '<h2 class="main-title">';
				    the_title();
				  echo '</h2>';
				    the_excerpt();
				echo '</header>';
		    }
		}
	        wp_reset_postdata();
    }
        if($staff_section_cat){

        $staff_qry = new WP_Query( array( 'cat' => $staff_section_cat, 'posts_per_page' => "1", 'ignore_sticky_posts'   => true ) );
            
            if( $staff_qry->have_posts() ){
	 
			echo '<div id="staff-slider">';
				echo '<div class="slides">';
                    while($staff_qry->have_posts()){ $staff_qry-> the_post();
						echo '<div>';
							echo '<div class="holder">';
								echo '<div class="img-holder">';
									if( has_post_thumbnail() ){
										the_post_thumbnail( 'bakes-and-cakes-staff-thumb', array( 'itemprop' => 'image' ));
									}else{
										bakes_and_cakes_get_fallback_svg( 'bakes-and-cakes-staff-thumb' );
									}
								echo '</div>';
								echo '<div class="text-holder">';
									echo '<strong class="name">';
										the_title();
									echo '</strong>';
									echo '<p>';
								      the_content();
									echo '</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
	                }
				echo'</div>';
				echo '<div id="loader"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>';
			echo '</div>';
			wp_reset_postdata();
			}
			$qry = new WP_Query( array( 'cat' => $staff_section_cat, 'posts_per_page' => -1, 'ignore_sticky_posts'   => true ) );
            
			echo '<div id="carousel" class="owl-carousel">';
				if( $staff_section_cat && $qry->have_posts() ){ $i = 0;
					while( $qry->have_posts() ){ $i++; 
						$qry->the_post(); 
						?>
						<div class="item img-btn <?php if( $i == 1 ){echo "current";} ?>" id= "<?php the_title(); ?>" >
							<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'thumbnail', array( 'itemprop' => 'image' ) ); 
						} else{
							bakes_and_cakes_get_fallback_svg( 'thumbnail' );
						}?>
						</div>
			<?php 
					}
					wp_reset_postdata();
				}
			echo '</div>';
 
		echo '</div>';
	}
		?>
