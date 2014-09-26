<?php


class Ticket extends Eloquent {

    /**
     * @var string The database table used by the model.
     */
    protected $table = 'tickets';

    protected $softDelete = 'true';

    /* Defines values that cannot be filled from array */
    protected $guarded = array('id', 'number');

    public function creator(){
        return $this->belongsTo('User', 'creator_id');
    }

    public function workLogs(){
        return $this->hasMany('WorkLog');
    }

    /**
     * @var array Array of rules used to validate form input prior to submitting
     */
    public static $validation_rules = array(
        'title' => 'sometimes|required|max:255',
        'creator_id' => 'sometimes|required',
        'project_id' => 'sometimes|required',
        'owner_id' => 'sometimes|required',
        'actual_hours' => 'numeric',
        'planned_hours' => 'numeric'
    );


    /**
     * Defines the tickets relationship to it's owner.
     * This allows use of the 'owner' attribute as if it were a User model.
     *
     * @example: $owner = $ticket->owner; echo $owner->username;
     * 
     */
    public function owner(){
        return $this->belongsTo('User', 'owner_id');
    } 

    /**
     * Defines the tickets relationship to it's project
     * @example $project = $ticket->owner; echo $project->title
     * 
     */
    public function project(){
        return $this->belongsTo('Project');
    }

    public function comments(){
        return $this->hasMany('Comment');
    }

    public function due(){
        return $this->belongsTo('Week', 'week_due_id');
    }

    public function completed(){
        return $this->belongsTo('Week', 'week_completed_id');
    }

    /**
     * Generate the url to the ticket's home page
     *
     * @return string The url to the tickets home page
     */
    public function getUrl(){
        return URL::to("project/" . $this->project->name . "/ticket/" . $this->number);
    }

    /**
     * Generates a safe, description string containing html from the parsed markdown
     *
     * @return The description as whitelisted html
     */
    public function parsedDescription(){
        $purifier_config = HTMLPurifier_Config::createDefault();
        $parser = new \Michelf\MarkdownExtra;

        $purifier_config->set('Core.Encoding', 'UTF-8');
        $purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
        $purifier_config->set('Cache.DefinitionImpl', null);
        $purifier_config->set('HTML.Allowed', 'em,strong,ol,ul,li, h1,h2,h3,h4,h5,h6,pre,code[class],a[href|title],blockquote[cite]');
        $purifier = new HTMLPurifier($purifier_config);
        return $purifier->purify($parser->transform($this->description));
    }

    /**
     * Generates a description with markdown syntax removed. Used for description previes
     *
     * @return The html/markdown-free description
     */
    public function strippedDescription(){

        $purifier_config = HTMLPurifier_Config::createDefault();
        $parser = new \Michelf\MarkdownExtra;
        $purifier_config->set('Core.Encoding', 'UTF-8');
        $purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
        $purifier_config->set('Cache.DefinitionImpl', null);
        $purifier = new HTMLPurifier($purifier_config);
        return $purifier->purify(strip_tags($parser->transform($this->description)));
    }

    public function ticketsOwned(){
        return $this->hasMany('Ticket', 'owner_id');
    }

    public function computeActualHours(){
        $sum =  $this->workLogs()->sum('value');
        if($sum){
            return $sum;
        }
        return '0.0';
    }

    public function deleteUrl(){
        return URL::route('deleteTicket', 
            array(
                'project_name' => $this->project->name, 
                'ticket_number' => $this->number
            )
        );
    }

    public static function create(array $attributes){
        // Oh no!
        //
        // This is very scary but have no fear
        //
        // All I'm doing is creating the ticket with a number unique for
        // that ticket.
        $model = new static($attributes);
        $pdo = DB::connection()->getPdo();
        $unprepared_query = "INSERT INTO tickets (" .
            "created_at, updated_at,".
            "title," .
            "description," .
            "number," .
            "planned_hours," .
            "actual_hours," .
            "due_date," .
            "project_id," .
            "creator_id, " .
            "owner_id," .
            "week_due_id," .
            "week_completed_id)" .
            "VALUES (NOW(),NOW(),?,?," .
            "1 + " .
            "(SELECT COUNT(*) FROM (SELECT id FROM tickets WHERE project_id = ?) " .
            " as myAlias )," .
            "?,?,?,?,?,?,?, ?);";
        $pq = $pdo->prepare($unprepared_query);
        $result = $pq->execute(
            array($model->title, 
            $model->description, 
            $model->project->id,
            $model->planned_hours,
            $model->actual_hours ? $model->actual_hours : 0,
            $model->due_date, $model->project->id,
            $model->creator ? $model->creator->id : NULL,
            $model->owner ? $model->owner->id : $model->creator->id, 
            $model->week_due ? $model->week_due->id : NULL,
            $model->week_completed ? $model->week_due->id : NULL
        )
    );
        return self::find($pdo->lastInsertId());
    }

}
