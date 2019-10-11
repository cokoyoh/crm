@csrf
<div class="field mb-6">
    <label for="title" class="label text-sm mb-2 block">Name</label>

    <div class="control">
        <input type="text"
               class="input bg-transparent border border-gray-300 rounded p-2 text-sm w-full"
               value="{!! $company->name !!}"
               name="name"
               required
               placeholder="Million Dollar LLC">
    </div>
</div>

<div class="field mb-6">
    <label for="description" class="label text-sm mb-2 block">Email</label>

    <div class="control">
        <input type="email"
               class="input bg-transparent border border-gray-300 rounded p-2 text-sm w-full"
               value="{!! $company->email !!}"
               name="email"
               required
               placeholder="company@domain.com">
    </div>
</div>

<div class="field mb-6">
    <button type="submit" class="button mr-5">{!! $buttonText !!}</button>
{{--    <a href="{!! $project->path() !!}" class="py-2 text-gray-500">Cancel</a>--}}
</div>

@include('errors')
