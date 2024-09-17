<div class="form_content">
    <<?php echo is_page('show-builder') ? 'h2' : 'h1'?> class="text-white"><?php echo $header; ?></<?php echo is_page('show-builder') ? 'h2' : 'h1'?>>
    <p class="text-white"><?php echo $p_text; ?></p>
    <?php echo do_shortcode($shortcode); ?>
</div>
<style>

section.<?php echo $section; ?> form p{
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 0;
}
section.<?php echo $section; ?> form span:not(:last-child):not(:nth-child(5)){
    width: calc(50% - 7.5px);
}
section.<?php echo $section; ?> input,
section.<?php echo $section; ?> textarea{
    padding: 10px 15px;
    border-radius: 5px;
    background: #EFEFEF;
    color: #848484;
    font-family: 'Inter',sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 300;
    line-height: 25px; /* 138.889% */
    width: 100%;
    border: none;
}
section.<?php echo $section; ?> input[type="submit"]{
    padding: 10px 20px;
    border-radius: 5px;
    background: var(--Linear, linear-gradient(180deg, #626262 0%, #000 100%));
    color: #FFF;
    font-family: "Roboto Condensed",sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;
    margin-top: 15px;
}
section.<?php echo $section; ?> input[type="submit"]:hover{
    transition: .5 ease all;
    background: var(--Linear, linear-gradient(180deg, #FFF 0%, #BDBDBD 100%));
    color: var(--secondary_font_color);
    -webkit-transition: .5 ease all;
    -moz-transition: .5 ease all;
    -ms-transition: .5 ease all;
    -o-transition: .5 ease all;
}
section.<?php echo $section; ?> textarea{
    max-height: 125px;
}
section.<?php echo $section; ?> input::placeholder,
section.<?php echo $section; ?> textarea::placeholder{
    color: #848484;
    font-family: 'Inter',sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 300;
    line-height: 25px; /* 138.889% */
}
section.<?php echo $section; ?> .form_content{
    padding: 40px 50px;
    border-radius: 10px;
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/<?php echo $section; ?>/<?php echo $section; ?>_content_bg.jpg')no-repeat center center/cover;
}
section.<?php echo $section; ?> .wpcf7-form-control-wrap{
    width: 100%;
}
section.<?php echo $section; ?> .form_content p{
    margin-bottom: 30px;
}
@media (max-width: 767px) {
    section.<?php echo $section; ?> .form_content{
        padding: 30px;
    }
}
</style>