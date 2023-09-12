<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @SuppressWarnings(PHPMD)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class Button extends Component
{
    public function __construct(
        public ?string $xs = null,
        public ?string $sm = null,
        public ?string $lg = null,
        public ?string $size = null,
        public ?string $primary = null,
        public ?string $secondary = null,
        public ?string $success = null,
        public ?string $danger = null,
        public ?string $warning = null,
        public ?string $info = null,
        public ?string $light = null,
        public ?string $dark = null,
        public ?string $link = null,
        public ?string $white = null,
        public ?string $color = null,
        public ?string $outline = null,
        public ?string $pill = null,
        public ?string $circle = null,
        public ?string $noRounded = null,
        public ?string $rounded = null,
        public ?string $roundedPosition = null,
        public ?string $left = null,
        public ?string $right = null,
        public ?string $position = null,
        public ?string $type = null,
        public ?string $href = null,
    ) {
        // sizes
        $this->size = $this->size ?? 'md';
        if ($this->xs) {
            $this->size = 'xs';
        }
        if ($this->sm) {
            $this->size = 'sm';
        }
        if ($this->lg) {
            $this->size = 'lg';
        }

        // colors
        $this->color = $this->color ?? 'primary';
        if ($this->primary) {
            $this->color = 'primary';
        }
        if ($this->secondary) {
            $this->color = 'secondary';
        }
        if ($this->success) {
            $this->color = 'success';
        }
        if ($this->danger) {
            $this->color = 'danger';
        }
        if ($this->warning) {
            $this->color = 'warning';
        }
        if ($this->info) {
            $this->color = 'info';
        }
        if ($this->light) {
            $this->color = 'light';
        }
        if ($this->dark) {
            $this->color = 'dark';
        }
        if ($this->link) {
            $this->color = 'link';
        }
        if ($this->white) {
            $this->color = 'white';
        }

        // rounded
        $this->roundedPosition = in_array($this->rounded, ['left', 'right']) ? $this->rounded : 'initial';
        $this->rounded         = $this->rounded ?? 'default';
        if ($this->pill) {
            $this->rounded = 'pill';
        }
        if ($this->circle) {
            $this->rounded = 'circle';
        }
        if ($this->noRounded) {
            $this->rounded = 'none';
        }
    }

    private function getClasses()
    {
        return [
            'btn',

            // sizes
            'btn-sm' => $this->size === 'sm',
            'btn-lg' => $this->size === 'lg',

            // colors
            'btn-primary'   => $this->color === 'primary',
            'btn-secondary' => $this->color === 'secondary',
            'btn-success'   => $this->color === 'success',
            'btn-danger'    => $this->color === 'danger',
            'btn-warning'   => $this->color === 'warning',
            'btn-info'      => $this->color === 'info',
            'btn-light'     => $this->color === 'light',
            'btn-dark'      => $this->color === 'dark',
            'btn-link'      => $this->color === 'link',
            'btn-white'     => $this->color === 'white',

            // outline
            'btn-outline-primary'   => $this->color === 'primary' && $this->outline,
            'btn-outline-secondary' => $this->color === 'secondary' && $this->outline,
            'btn-outline-success'   => $this->color === 'success' && $this->outline,
            'btn-outline-danger'    => $this->color === 'danger' && $this->outline,
            'btn-outline-warning'   => $this->color === 'warning' && $this->outline,
            'btn-outline-info'      => $this->color === 'info' && $this->outline,
            'btn-outline-light'     => $this->color === 'light' && $this->outline,
            'btn-outline-dark'      => $this->color === 'dark' && $this->outline,

            // rounded
            'rounded-top'        => $this->rounded === 'top',
            'rounded-bottom'     => $this->rounded === 'bottom',
            'rounded-left'       => $this->rounded === 'left',
            'rounded-right'      => $this->rounded === 'right',
            'rounded-lg'         => $this->rounded === 'lg',
            'rounded-sm'         => $this->rounded === 'sm',
            'rounded-0'          => $this->rounded === 'none',
            'rounded-1'          => $this->rounded === '1',
            'rounded-2'          => $this->rounded === '2',
            'rounded-3'          => $this->rounded === '3',
            'rounded-start'      => $this->rounded === 'start',
            'rounded-end'        => $this->rounded === 'end',
            'rounded-pill'       => $this->rounded === 'pill',
            'rounded-left-pill'  => $this->rounded === 'pill' && $this->roundedPosition === 'left',
            'rounded-right-pill' => $this->rounded === 'pill' && $this->roundedPosition === 'right',
            'rounded-circle'     => $this->rounded === 'circle',

            // position
            'float-left'  => $this->position === 'left',
            'float-right' => $this->position === 'right',
        ];
    }

    public function render()
    {
        $view = !$this->href ? 'button' : 'button-link';

        return view('components.' . $view, [
            'class' => $this->getClasses(),
            'type'  => $this->type,
            'href'  => $this->href,
        ]);
    }
}
