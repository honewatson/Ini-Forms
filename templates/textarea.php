<div class="control-group">
            <label for="<?php echo $field; ?>" class="<?php echo $label_class; ?>"><?php echo $label; ?></label>
            <div class="controls">
              <textarea rows="<?php echo $rows; ?>" cols="<?php echo $cols; ?>" id="<?php echo $field; ?>" name="<?php echo $field; ?>" class="<?php echo $field_class; ?>"><?php echo $value; ?></textarea>
              <?php if($help): ?>
                <p class="help-block"><?php echo $help; ?></p>
              <?php endif; ?>
            </div>
</div>

