<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package F2
 * @since F2 2.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php f2_footer_text(); ?>
		</div>
		<?php if( f2_get_option('hide_footer_credits') != 'on' ) : ?>
			<div class="f2-credits">
				<?php do_action( 'f2_credits' ); ?>
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'f2' ); ?>" rel="generator"><?php printf( __( 'Powered by %s', 'f2' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<a href="<?php echo esc_url( 'http://srinig.com/wordpress/themes/f2/' ); ?>"><?php printf( __( 'Theme %1$s.', 'f2' ), 'F2' ); ?></a>
			</div><!-- .f2-credits -->
		<?php endif; ?>
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1971d912441f1671e986ea71cd1e600c' type='text/javascript'%3E%3C/script%3E"));
</script>

</body>
</html>