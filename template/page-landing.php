<?php
if (is_page('Fourth of July Fireworks')) :
    get_template_part('categories_landing_page/fourth-of-july');

elseif (is_tax('product_cat', 'wholesale-fireworks')) :
    get_template_part('categories_landing_page/whole-sale');

elseif (is_page('Gender Reveal Fireworks')) :
    get_template_part('template/random', 'product');

elseif (is_page('Wedding  Fireworks')) :
    get_template_part('categories_landing_page/fireworks-for-wedding');

elseif (is_page('GRAND FINALE')) :
    get_template_part('categories_landing_page/grand-finale');
endif;
