<?php

/**
*  Represents a comment on a ticket.
*/
class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';
	

    /**
     * Used to Query the author User Model of the comment.
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo The relation used to retrieve the author
     */
	public function user(){
		return $this->belongsTo('User');
	} 

    /**
     * Used to Query the ticket Model of the ticket being commented on.
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo The relation used to retrieve the ticket
     */
	public function ticket(){
		return $this->belongsTo('Ticket');
    }

    /**
     * Gets a safe html formatted comment from the markdown comment source.
     *
     * @return string
     */
	public function parsedContent(){
		$purifier_config = HTMLPurifier_Config::createDefault();
		$parser = new \Michelf\MarkdownExtra;

		$purifier_config->set('Core.Encoding', 'UTF-8');
		$purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
		$purifier_config->set('Cache.DefinitionImpl', null);
		$purifier_config->set('HTML.Allowed', 'strong,em,ol,ul,li,h1,h2,h3,h4,h5,h6,pre,code[class],a[href|title],blockquote[cite]');
		$purifier = new HTMLPurifier($purifier_config);
		return $purifier->purify($parser->transform($this->content));

	}

}
