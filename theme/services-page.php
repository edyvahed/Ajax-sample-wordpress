
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

