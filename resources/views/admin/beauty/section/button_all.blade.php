<div class="flex min-w-xl gap-6">

    <div class="field w-20 md:w-36 whitespace-nowrap">
        <span class="input-icon right-0 pr-3">
            <i class="fa-solid fa-caret-down"></i>
        </span>
        <select wire:model="byState" class="input select">
            <option value="">文章狀態篩選</option>
            <option value="'0'">草稿</option>
            <option value="1">等待發布</option>
            <option value="2">已發布</option>
            <option value="3">停用</option>
        </select>
    </div>

    <div class="flex items-center">
        <div class="flex gap-2 items-center">

            <span class="label">停用：</span>

            <button class="button primary-btn" title="停用" id="suspendBtn" name="submit" value="hide">
                停用
            </button>

            <button class="button secondary-btn" title="取消停用" id="cancelSuspendBtn" name="submit"
                value="show">
                取消停用
            </button>
        </div>
    </div>
    <button class="button danger-btn" title="刪除" value="delete" name="submit">
        <span class="icon">
            <i class="fa-solid fa-trash-can"></i>
        </span>
        <span>刪除</span>
    </button>
</div>
