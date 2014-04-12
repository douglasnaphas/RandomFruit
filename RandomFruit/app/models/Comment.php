<?php


class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';
	

	public function user(){
		return $this->belongsTo('User');
	} 

	public function ticket(){
		return $this->belongsTo('Ticket');
	}

	public function parsedContent(){
		$purifier_config = HTMLPurifier_Config::createDefault();
		$parser = new \Michelf\MarkdownExtra;

		$purifier_config->set('Core.Encoding', 'UTF-8');
		$purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
		$purifier_config->set('Cache.DefinitionImpl', null);
		$purifier_config->set('HTML.Allowed', 'ol,ul,li, h1,h2,h3,h4,h5,h6,pre,code[class],a[href|title],blockquote[cite]');
		$purifier = new HTMLPurifier($purifier_config);
		return $purifier->purify($parser->transform($this->content));

	}

}
