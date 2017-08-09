<?php
/*
Plugin Name: Fluid Accessible Inline Edit
Plugin URI: http://wordpress.org/extend/plugins/fluid-accessible-inline-edit/
Description: WAI-ARIA Enabled Inline Edit Plugin for Wordpress
Author: Dionysia Kontotasiou
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "FluidAccessibleInlineEdit_init");
function FluidAccessibleInlineEdit_init() {
    register_sidebar_widget(__('Fluid Accessible Inline Edit'), 'widget_FluidAccessibleInlineEdit');
    register_widget_control(   'Fluid Accessible Inline Edit', 'FluidAccessibleInlineEdit_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_FluidAccessibleInlineEdit') ) {
        wp_register_script('InfusionAll', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/InfusionAll.js'));
        wp_enqueue_script('InfusionAll');

        wp_register_script('FluidAccessibleInlineEdit', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/FluidAccessibleInlineEdit.js'));
        wp_enqueue_script('FluidAccessibleInlineEdit');

		wp_register_style('inlineedit', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/InlineEdit.js'));
        wp_enqueue_style('inlineedit');
		
		wp_register_style('inlineeditintegration', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/InlineEditIntegrations.js'));
        wp_enqueue_style('inlineeditintegration');
		
		wp_register_style('inlineedit_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/InlineEdit.css'));
        wp_enqueue_style('inlineedit_css');
		
		wp_register_style('inlineedit_json', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/inlineEditDependencies.json'));
        wp_enqueue_style('inlineedit_json');
		
		wp_register_style('tooltip', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-inline-edit/lib/Tooltip.json'));
        wp_enqueue_style('tooltip');
    }
}

function widget_FluidAccessibleInlineEdit($args) {
    extract($args);

    $options = get_option("widget_FluidAccessibleInlineEdit");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'Fluid Accessible Inline Edit',
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
  FluidAccessibleInlineEditContent();
    echo $after_widget;
}

function FluidAccessibleInlineEditContent() {

    $options = get_option("widget_FluidAccessibleInlineEdit");
    if (!is_array($options)) {
        $options = array(
            'title' => 'Fluid Accessible Inline Edit',
        );
    }

    echo '<class="demo-inlineEdit-indent">
			
        <div class="demoSelector-inlineEdit-container-title">    
            <p class="flc-inlineEdit-text demo-inlineEdit-title"></p> 
        </div>
        
        <img class="demo-inlineEdit-padding" src="./wp-content/plugins/fluid-accessible-inline-edit/images/banana.jpg" alt="shiny red car" />
               
        <div class="demoSelector-inlineEdit-container-caption demo-inlineEdit-padding">
            <strong>Caption: </strong>
            <p class="flc-inlineEdit-text">A yellow banana</p> 
        </div>
        
        <script type="text/javascript">
            demo.initInlineEdit();
        </script>    ';
}

function FluidAccessibleInlineEdit_control() {
    $options = get_option("widget_FluidAccessibleInlineEdit");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'Fluid Accessible Inline Edit',
        );
    }

    if ($_POST['FluidAccessibleInlineEdit-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['FluidAccessibleInlineEdit-WidgetTitle']);
        update_option("widget_FluidAccessibleInlineEdit", $options);
    }

    ?>
    <p>
        <label for="FluidAccessibleInlineEdit-WidgetTitle">Widget Title: </label>
        <input type="text" id="FluidAccessibleInlineEdit-WidgetTitle" name="FluidAccessibleInlineEdit-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="FluidAccessibleInlineEdit-SubmitTitle" name="FluidAccessibleInlineEdit-SubmitTitle" value="1" />
    </p>
    
    <?php
}

?>
