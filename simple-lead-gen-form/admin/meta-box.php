<div class="slgf_box">
    <style scoped>
        .slgf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .slgf_field{
            display: contents;
        }
    </style>
    <p class="meta-options slgf_field">
        <label for="slgf_phone">Phone</label>
        <input id="slgf_phone" type="number" name="slgf_phone" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'slgf_phone', true)); ?>">
    </p>
    <p class="meta-options slgf_field">
        <label for="slgf_email">Email</label>
        <input id="slgf_email" type="email" name="slgf_email" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'slgf_email', true)); ?>">
    </p>
    <p class="meta-options slgf_field">
        <label for="slgf_budget">Budget</label>
        <input id="slgf_budget" type="number" name="slgf_budget" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'slgf_budget', true)); ?>">
    </p>
    <p class="meta-options slgf_field">
        <label for="slgf_message">Message</label>
        <textarea id="slgf_message" type="number" name="slgf_message" rows="4"><?php echo esc_attr(get_post_meta(get_the_ID(), 'slgf_message', true)); ?></textarea>
    </p>
    <p class="meta-options slgf_field">
        <label for="slgf_date">Date</label>
        <input id="slgf_date" type="date" name="slgf_date" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'slgf_date', true)); ?>">
    </p>
    <p class="meta-options slgf_field">
        <label for="slgf_time">Time</label>
        <input id="slgf_time" type="time" name="slgf_time" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'slgf_time', true)); ?>">
    </p>
</div>
