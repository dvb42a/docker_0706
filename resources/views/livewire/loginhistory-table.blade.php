<div >
    <section class="relative top-[68px] p-6 flex flex-col mx-auto max-w-3xl">
        <!-- media-container -->
        <div>
            <h3 class="h2">登入紀錄</h3>
        </div>
        <table class="table table-auto mt-4">
            <thead>
                <tr>
                    <th>
                        登入時間
                    </th>
                    <th>
                        登入狀態
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($logs as $log)
                <tr class="list-el">
                    <td class="login-time">
                        {{ $log->login_at }}
                    </td>
                    @switch($log->status)
                        @case(0)
                            <td class="is-failed">
                                <span class="mr-1">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                                登入失敗
                            </td>
                        @break
                        @case(1)
                            <td class="is-success">
                                <span class="mr-1">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                登入成功
                            </td>
                        @break
                    @endswitch
                </tr>
            @empty
                查無此結果。
            @endforelse

            </tbody>
        </table>
    </section>
</div>
