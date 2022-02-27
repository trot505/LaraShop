<h1>{{ $title }}</h1>
@php $data = $user->makeHidden([
    'email_verified_at',
    'is_admin',
    'file_path',
    'created_at',
    'updated_at'
])->load(['addresses' => function ($q){
    $q->select('id','address', 'main', 'user_id');
}]);
@endphp
<user-profile :muser="{{ $data }}"></user-profile>
