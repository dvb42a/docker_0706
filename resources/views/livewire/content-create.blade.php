<form wire:submit.prevent="submit" class="my-5 bg-white rounded-lg shadow-lg p-8 flex flex-col gap-6 min-w-[400px] w-1/3 max-w-[640px]">
    @csrf

    <div class="page-head gap-2 flex-col">
        <h2 class="h2">
            新增文章
        </h2>
        <h5 class="h5">步驟一:建立文章基本資料</h5>
    </div>

    <div class="field">
        <label class="label"> 文章標題 </label>
        <input class="input @error('bp_subsection_title') input-warning  @enderror" type="text" placeholder="輸入文章標題"
            name="bp_subsection_title" wire:model="bp_subsection_title">

        @error('bp_subsection_title')
            <p class="help danger">{{ $message }}</p>
        @else
            <p class="help">文章標題限40字內，包含中英數字及符號且不能與現有標題相同</p>
        @enderror
    </div>

    <div class="flex justify-end">
        <button class="button primary-btn bg-primary" type="button" wire:click="submit"> 下一步 </button>
    </div>
</form>
