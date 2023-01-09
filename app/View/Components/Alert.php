<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
  /**
  * Create a new component instance.
  *
  * @return void
  */

  /**
  * 警告タイプ
  *
  * @var string
  */
  public $type;

  /**
  * 警告メッセージ
  *
  * @var string
  */
  public $session;

  public function __construct($type, $session)
  {
    $this->type = $type;
    $this->session = $session;
  }

  /**
  * Get the view / contents that represent the component.
  *
  * @return \Illuminate\Contracts\View\View|\Closure|string
  */
  public function render()
  {
    return view('components.alert');
  }
}
