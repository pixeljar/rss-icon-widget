<div class="wrap">
	<h1><?php esc_html_e( 'RSS Icon Widget Changelog', 'rssiw' ); ?></h1>

	<h3>5.2</h3>
	<ul>
		<li>Removes deprecated functions</li>
		<li>Updates the colorpicker to WordPress' built-in library</li>
		<li>Adds changelog</li>
	</ul>

	<h3>5.1</h3>
	<ul>
		<li><?php esc_html_e( 'Added new Dynamic RSS Icon Widget that dynamically constructs the URL of the feed for the archive that the user is looking at', 'rssiw' ); ?></li>
	</ul>

	<h3>5.0</h3>
	<ul>
		<li><?php esc_html_e( 'Changed widget constructors', 'rssiw' ); ?></li>
	</ul>

	<h3>4.0</h3>
	<ul>
		<li><?php
			printf(
				esc_html__( 'Added option to open links in a new window (props %s)', 'rssiw' ),
				'B.Chamberlain'
			);
		?></li>
	</ul>

	<h3>3.0</h3>
	<ul>
		<li><?php esc_html_e( 'Cleaned up code', 'rssiw' ); ?></li>
		<li><?php
			printf(
				esc_html__( 'Removed legacy (pre-%s) support', 'rssiw' ),
				'2.8'
			);
		?></li>
		<li><?php esc_html_e( 'Added escaping for security purposes', 'rssiw' ); ?></li>
		<li><?php esc_html_e( 'Added translation support', 'rssiw' ); ?></li>
	</ul>

	<div class="pixel-jar-ads">
		<h3><?php esc_html_e( 'More from Pixel Jar', 'rssiw' ); ?></h3>

		<div class="ad-flex-container">
			<div class="ad">
				<a href="https://www.pixeljar.com/" target="_blank">
					<img
						src="<?php echo RSSIW_ASSETS . 'images/pixel-jar.svg' ?>" 
						alt="<?php esc_attr_e( 'Pixel Jar logo', 'rssiw' ); ?>"
					/>
				</a>
				<p><?php
					printf(
						wp_kses(
							__( 'RSS Icon Widget is proudly powered by %1$s. We’re a small web development agency that focuses on %2$s as a development platform for websites. %1$s started in 2004. It grew out of the desire to be free to choose projects that challenge us and work with clients that inspire us. Read more about us <a href="%3$s" target="_blank">here</a>.', 'rssiw' ),
							array( 'a' => array(
								'href'   => array(),
								'target' => array(),
							) )
						),
						'Pixel Jar',
						'WordPress',
						'https://www.pixeljar.com'
					);
				?></p>
			</div>

			<div class="ad">
				<a href="https://adsanityplugin.com/" target="_blank">
					<img
						src="<?php echo RSSIW_ASSETS . 'images/adsanity.svg' ?>" 
						alt="<?php esc_attr_e( 'AdSanity logo', 'rssiw' ); ?>"
					/>
				</a>
				<p><?php
					printf(
						wp_kses(
							__( '%1$s also makes %2$s, a light ad rotator plugin for %3$s. It allows the user to create and manage ads shown on a website as well as keep statistics on views and clicks through a robust set of features. You can read all about it on the <a href="%4$s" target="_blank">%2$s site</a>.', 'rssiw' ),
							array( 'a' => array(
								'href'   => array(),
								'target' => array(),
							) )
						),
						'Pixel Jar',
						'AdSanity',
						'WordPress',
						esc_url( 'https://adsanityplugin.com/' )
					);
					?>
				</p>
			</div>
		</div>
	</div>
</div>
