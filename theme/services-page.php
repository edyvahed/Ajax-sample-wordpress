<?php
/**
 * Template Name: قالب صفحه خدمات
 *
 * Services Page Layout
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) :
	the_post(); ?>

	<div id="HeadBox">
		<div class="container">
			<h3><?php the_title(); ?></h3>
			<?php the_content(); ?>
		</div>
	</div>
    <div id="servicesTitle">
     <div class="container">
      <div class="row">
		<h3 class="col-md-6">عاملیت های فروش و خدمات پس از فروش</h3>
        <span class="col-md-6 cities">
            <?php
            $categories = get_terms( 'region', 'orderby=id&hide_empty=0' );
            ?>
            <select id="branchselect">
                <?php
                foreach ( $categories as $term ) {
                    ?>
                    <option value="<?php echo $term->term_id ?>"><?php echo $term->name; ?></option>
                <?php
                }
                ?>
            </select>
            <h4>انتخاب شهر مورد نظر :</h4>
        </span>
	  </div>
     </div>
    </div>
	<div id="Selling_Table">
		<div class="container">
			<div class="row selling_table">
				<div id="data-holder" class="col-md-12">
					<div class="loading"></div>
                    <table id="branchTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>عاملیت</th>
                            <th>مسئول</th>
                            <th>آدرس</th>
                            <th>تلفن</th>
                            <th>فکس</th>
                            <th>پست الکترونیک</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $args  = array(
                            'post_type' => 'branches',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'region',
                                    'field'    => 'slug',
                                    'terms'    => 'tehran'
                                )
                            )
                        );
                        $query = new WP_Query( $args );
                        // The Loop
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                ?>
                                <tr>
                                    <td><?php the_field( 'code' ); ?></td>
                                    <td><?php the_title(); ?></td>
                                    <td><?php the_field( 'agent' ); ?></td>
                                    <td><?php the_field( 'address' ); ?></td>
                                    <td><?php the_field( 'tel' ); ?></td>
                                    <td><?php the_field( 'fax' ); ?></td>
                                    <td class="latin"><?php the_field( 'email' ); ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            // no posts found
                        }
                        wp_reset_postdata();
                        ?>
                        </tbody>
                    </table>
					<div id="results"></div>
				</div>
				<div class="col-md-12">
					<hr/>
					<p> برای مشاهده اطلاعات بیشتر نمایندگی های فروش و خدمات پس از فروش و اطلاع از شرایط فروش محصولات می
						توانید به سایت <a href="http://www.pac.ir/">شرکت پرستوی آبی ارگ</a> مراجعه نمایید.</p>
				</div>
			</div>
		</div>
	</div>

	<div id="Services_Contact-Us-Page">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h3>اطلاعات تماس شرکت پرستوی آبی ارگ</h3>
					<dl>
						<dt>آدرس:
						<dd><?php the_field( 'address', 'option' ); ?></dd>
						</dt>
						<dt>تلفن تماس:
						<dd><?php the_field( 'tel', 'option' ); ?></dd>
						</dt>
						<dt>فکس:
						<dd><?php the_field( 'fax', 'option' ); ?></dd>
						</dt>
						<dt>پست الکترونیک
						<dd><?php the_field( 'email', 'option' ); ?></dd>
						</dt>
					</dl>
				</div>
				<div class="col-md-6">
					<div id="map">
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endwhile;
endif;
?>


<?php get_footer(); ?>

