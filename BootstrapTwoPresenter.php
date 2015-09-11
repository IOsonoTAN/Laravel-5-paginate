<?php
/**
 * Source: http://fullstackstanley.com/read/bootstrap-2-pagination-in-laravel-5
 * Editor: Krissada Boontrigratn
 * Steps to use:
 *   1. Create new folder name is 'Presenters' under folder 'app' (app/Presenters)
 *   2. Create new file name is 'BootstrapTwoPresenter.php'
 *   3. Copy on this file and paste into 'BootstrapTwoPresenter.php' (app/Presenters/BootstrapTwoPresenter.php)
 *   4. In blade template just called '{!! $users->appends(['sort' => 'votes', 'order' => 'desc'])->render(new App\Presenters\BootstrapTwoPresenter($users)) !!}'
 */

namespace App\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

class BootstrapTwoPresenter extends BootstrapThreePresenter
{
  public function render()
  {
    if( ! $this->hasPages())
      return '';

    return sprintf(
      '<ul class="pagination">%s %s %s %s %s</ul>',
      $this->getFirstButton(),
      $this->getPreviousButton(),
      $this->getLinks(),
      $this->getNextButton(),
      $this->getLastButton()
    );
  }

  public function appends($attributes){
    if (is_string($attributes)) {
      $attributes = func_get_args();
    }

    $this->appends = array_unique(
      array_merge($this->appends, $attributes)
    );

    return $this;
  }

  public function getFirstButton($text = 'First')
  {
      if($this->currentPage() != 1){
        $url = $this->paginator->url(1);
        return $this->getPageLinkWrapper($url, $text, 'first');
      }
  }

  public function getLastButton($text = 'Last')
  {
      if($this->currentPage() != $this->lastPage()){
        $url = $this->paginator->url($this->lastPage());
        return $this->getPageLinkWrapper($url, $text, 'last');
      }
  }

  public function getPreviousButton($text = '&laquo;')
    {
      if($this->currentPage() != 1){
        if ($this->paginator->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text, 'prev');
      }
    }

    public function getNextButton($text = '&raquo;')
    {
      if($this->currentPage() != $this->lastPage()){
        if (! $this->paginator->hasMorePages()) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text, 'next');
      }
    }
}