<div class="control-group">
            <label for="<?php echo $field; ?>" class="<?php echo $label_class; ?>"><?php echo $label; ?></label>
            <div class="controls">
              <input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" class="<?php echo $field_class; ?>" <?php if($value) echo "value=\"$value\""; ?> />
              <?php if($help): ?>
                <p class="help-block"><?php echo $help; ?></p>
              <?php endif; ?>
            </div>
</div>