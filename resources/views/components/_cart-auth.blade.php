@php $user = Auth::user(); @endphp
<div class="flex-fill mt-3 fs-4">
    <i class="far fa-user fs-3 me-3"></i> {{ $user->name }}
</div>
<div class="flex-fill fs-4">
    <i class="fas fa-at fs-3 me-3"></i> {{ $user->email }}
</div>
<div class="flex-fill mt-3 mb-3">
    @php
        $defaultSelected = 'Aдрес';
        $selectName = 'address_id';
        $addresses = $user->addresses;

        $options = $addresses->map(function($a){
            return  (object)[
                'id' => $a->id,
                'name' => $a->address,
            ];
        })->collect();

        $selected = $addresses->filter(function($a){
            if ($a->main === 1) return $a;
        })->first()->id ?? null;
        //$selectOptions = compact('defaultSelected','selectName','options','selected','errors');
    @endphp
    @if($options->isEmpty())
        <div class="fs-5">У вас отсутсвуют адреса для доставки, перейдите в <a href="{{ route('profile.show', $user) }}" class="link-info">профиль</a> для добавления адреса.</div>
    @else @include('components._select') @endif

</div>
