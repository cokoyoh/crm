@csrf
<div class="field mb-6">
    <label for="title" class="label text-sm mb-2 block">Name</label>

    <div class="control">
        <input type="text"
               class="input appearance-none bg-transparent border border-gray-300 rounded py-3 px-4 text-sm w-full focus:outline-none focus:border-blue-300 focus:bg-white"
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
               class="input appearance-none bg-transparent border border-gray-300 rounded py-3 px-4 text-sm w-full focus:outline-none focus:border-blue-300 focus:bg-white"
               value="{!! $company->email !!}"
               name="email"
               required
               placeholder="company@domain.com">
    </div>
</div>

<div class="field mb-6">
    <button type="submit" class="btn btn-blue mr-5">{!! $buttonText !!}</button>
    <button class="btn btn-gray">
        <a href="{!! route('companies.index') !!}">Cancel</a>
    </button>
</div>

@include('errors')
