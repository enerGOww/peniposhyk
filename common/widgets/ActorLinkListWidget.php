<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use common\essence\Actor;
class ActorLinkListWidget extends Widget
{
    public $allActors;

    public function run()
    {
        foreach ($this->allActors as $actor_id){
            $actor = Actor::findOne($actor_id->actor_id);
            echo Html::a($actor->name, Url::to('/actor/view?id='.$actor->id)).' ';
        }

    }
}