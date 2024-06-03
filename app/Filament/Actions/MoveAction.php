<?php

namespace App\Filament\Actions;

use App\Models\Page;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;

class MoveAction extends Action
{
    use CanCustomizeProcess;

    public ?string $direction = null;

    public function direction($direction): self
    {
        $this->iconButton();

        $this->direction = $direction;

        $this->disabled(function (Page $page) {
            return $this->direction === 'up' ? !$page->canMoveUp() : !$page->canMoveDown();
        });

        $this->icon($this->direction === 'up' ? 'heroicon-o-arrow-small-up' : 'heroicon-o-arrow-small-down');

        $this->color(function (Page $page) {
            return !$this->isDisabled() ? 'primary' : 'gray';
        });

        $this->successNotificationTitle($this->direction === 'up' ? 'Moved up!' : 'Moved down!');

        $this->action(function (Page $page, Action $action) {
            $this->direction === 'up' ? $page->moveUp() : $page->moveDown();
            $action->sendSuccessNotification();
        });

        return $this;
    }
}
