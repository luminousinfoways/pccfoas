<?php
// source: /var/www/html/pccf/app/presenters/templates/Master/currency.latte

class Template04e79b6694bf40ec82779a2ce6b5fd13 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('79dd52bcfe', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba70c7a7678_content')) { function _lba70c7a7678_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="banner">
<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>
</div>
<div id="content">
	<h2>Manage Post</h2>
	<div class="boxes">		
<?php $_l->tmp = $_control->getComponent("currencyFormat"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
<?php $iterations = 0; foreach ($posts as $post) { ?>	<div class="data">
	    <h2><?php echo Latte\Runtime\Filters::escapeHtml($post->title, ENT_NOQUOTES) ?>
 <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("CurrencyFormatEdit", array($post->post_id)), ENT_COMPAT) ?>
">(Edit)</a></h2>
	    <div class="date"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($post->created, 'd-m-Y'), ENT_NOQUOTES) ?></div>
	    <div><?php echo Latte\Runtime\Filters::escapeHtml($post->content, ENT_NOQUOTES) ?></div>
	</div>
<?php $iterations++; } ?>
	<section id="template">
		<h2>This page template located at <span><?php echo Latte\Runtime\Filters::escapeHtml(strstr($presenter->template->getFile(), 'app'), ENT_NOQUOTES) ?></span></h2>

		<pre><code class="jush"><?php echo Latte\Runtime\Filters::escapeHtml($template->replacere(file_get_contents($presenter->template->getFile()), '#[\w+/]{60,}#', '…'), ENT_NOQUOTES) ?></code></pre>
	</section>

	<section id="layout">
		<h2>Layout template located at <span><?php echo Latte\Runtime\Filters::escapeHtml(strstr($template->getName(), 'app'), ENT_NOQUOTES) ?></span></h2>

		<pre><code class="jush"><?php echo Latte\Runtime\Filters::escapeHtml(file_get_contents($template->getName()), ENT_NOQUOTES) ?></code></pre>
	</section>

	<section id="presenter">
		<h2>Current presenter located at <span><?php echo Latte\Runtime\Filters::escapeHtml(strstr($presenter->getReflection()->getFileName(), 'app'), ENT_NOQUOTES) ?></span></h2>

		<pre><code class="jush-php"><?php echo Latte\Runtime\Filters::escapeHtml(file_get_contents($presenter->getReflection()->getFileName()), ENT_NOQUOTES) ?></code></pre>
	</section>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb3d833997d4_title')) { function _lb3d833997d4_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1>PCCF Office Automation!</h1>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbd8260ddc1e_scripts')) { function _lbd8260ddc1e_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ?>
<script src="https://files.nette.org/sandbox/jush.js"></script>
<script>
	jush.create_links = false;
	jush.highlight_tag('code');
	$('code.jush').each(function(){ $(this).html($(this).html().replace(/\x7B[/$\w].*?\}/g, '<span class="jush-latte">$&</span>')) });

	$('a[href^=#]').click(function(){
		$('html,body').animate({ scrollTop: $($(this).attr('href')).show().offset().top - 5 }, 'fast');
		return false;
	});
</script>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb19a60f0e9c_head')) { function _lb19a60f0e9c_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
	html { overflow-y: scroll; }
	body { font: 14px/1.65 Verdana, "Geneva CE", lucida, sans-serif; background: #3484d2; color: #333; margin: 38px auto; max-width: 940px; min-width: 420px; }

	h1, h2 { font: normal 150%/1.3 Georgia, "New York CE", utopia, serif; color: #1e5eb6; -webkit-text-stroke: 1px rgba(0,0,0,0); }

	img { border: none; }

	a { color: #006aeb; padding: 3px 1px; }

	a:hover, a:active, a:focus { background-color: #006aeb; text-decoration: none; color: white; }

	#banner { border-radius: 12px 12px 0 0; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAB5CAMAAADPursXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRFD1CRDkqFDTlmDkF1D06NDT1tDTNZDk2KEFWaDTZgDkiCDTtpDT5wDkZ/DTBVEFacEFOWD1KUDTRcDTFWDkV9DkR7DkN4DkByDTVeDC9TDThjDTxrDkeADkuIDTRbDC9SbsUaggAAAEdJREFUeNqkwYURgAAQA7DH3d3335LSKyxAYpf9vWCpnYbf01qcOdFVXc14w4BznNTjkQfsscAdU3b4wIh9fDVYc4zV8xZgAAYaCMI6vPgLAAAAAElFTkSuQmCC); }
	#banner h1 { color: white; font-size: 50px; line-height: 121px; margin: 0; padding-left: 4%; background: url(data:image/png;base64,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) no-repeat 95%; text-shadow: 1px 1px 0 rgba(0, 0, 0, .9); }
	@media (max-width: 600px) {
		#banner h1 { background: none; }
	}

	#content { background: white; border: 1px solid #eff4f7; border-radius: 0 0 12px 12px; padding: 10px 4%; overflow: hidden; }
	#content > h2 { font-size: 130%; color: #666; clear: both; padding: 1.2em 0; margin: 0; }

	h2 span { color: #87A7D5; }
	h2 a { text-decoration: none; background: transparent; }

	.boxes { -webkit-justify-content: space-between; justify-content: space-between; display: -webkit-flex; display: flex; margin-right: -2em; }
	.boxes > div { background: #f0f0f0; border: 1px solid #e6e6e6; border-radius: 5px; -webkit-flex: 1; flex: 1; margin-right: 2em; }
	.boxes h2 { text-align: right; margin: 1em; }
	.boxes img { float: left; }
	.boxes p { clear: both; margin: 1em; }
	.boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
	.boxes p a:hover, .boxes p a:active, .boxes p a:focus { color: white; background-color: #006aeb; }
	.boxes > div:nth-child(3n - 2) h2 { color: #00a6e5; }
	.boxes > div:nth-child(3n - 2) img { margin: -1em -1em 0 -1em; }
	.boxes > div:nth-child(3n - 1) h2 a { color: #db8e34; background: transparent; }
	.boxes > div:nth-child(3n) h2 a { color: #578404; background: transparent; }
	@media (max-width: 760px) {
		.boxes { -webkit-flex-direction: column; flex-direction: column; }
		.boxes > div { margin-bottom: 1em; flex-basis: auto; }
		.boxes h2 br { display: none; }
	}

	section { display: none; }

	pre { font-size: 12px; line-height: 1.4; padding: 10px; margin: 1.3em 0; overflow: auto; max-height: 500px; background: #F1F5FB; border-radius: 5px; box-shadow: 0 1px 1px rgba(0, 0, 0, .1); }

	.jush-com, .jush-php_doc { color: #929292; }
	.jush-tag, .jush-tag_js { color: #6A8527; font-weight: bold; }
	.jush-att { color: #8CA315 }
	.jush-att_quo { color: #448CCB; font-weight: bold; }
	.jush-php_var { color: #d59401; font-weight: bold; }
	.jush-php_apo { color: green; }
	.jush-php_new { font-weight: bold; }
	.jush-php_fun { color: #254DB3; }
	.jush-js, .jush-css { color: #333333; }
	.jush-css_val { color: #448CCB; }
	.jush-clr { color: #007800; }
	.jush a { color: inherit; background: transparent; }
	.jush-latte { color: #D59401; font-weight: bold }
</style>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>


<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 
}}