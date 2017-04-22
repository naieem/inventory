<?php

/*********************************
Display functions for information output
*********************************/
function widget() {
?>
<div style="-webkit-box-shadow:  0px 0px 7px 5px rgba(0, 0, 0, 0.1);-moz-box-shadow: 0px 0px 7px 5px rgba(0, 0, 0, 0.1);
box-shadow:  0px 0px 7px 5px rgba(0, 0, 0, 0.1); -webkit-border-radius: 5px;-moz-border-radius:5px;border-radius:5px;padding:20px;margin:20px auto;width:50%;height:30%position:relative;background-color:#f2f2f2;max-width:400px;">
      <p>
         <label for="sku"><?php echo __("Product Number (Sku)",'aia');?></label>
         <input id="sku" name="sku" value="" style="width:100%;" />
      </p>
      <p class="error">
        
      </p>

      <p>
         <label for="pur"><?php echo __("Quantity Purchased",'aia');?></label>
         <input id="pur" name="pur" value="" style="width:100%;" />
      </p>
      <p>
         <label for="sold"><?php echo __("Quantity Sold",'aia');?></label>
         <input id="sold" name="sold" value="" style="width:100%;" />
      </p>
      <p style="margin:20px 0px;">
         <input id="submit" name="submit" value="<?php echo __("Submit",'aia');?>" type="button" style="width:25%;" />
      </p>
      <p class="show" style="display:none;">
        
      </p>
</div>
<?php
}

add_shortcode( 'acxcom-inventory-adjust', 'widget' );
?>