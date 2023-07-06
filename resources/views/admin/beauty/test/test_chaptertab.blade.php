
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>content manage</title>

        <!-- import Bulma -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.css'
            integrity='sha512-SI0aF82pT58nyOjCNfyeE2Y5/KHId8cLIX/1VYzdjTRs0HPNswsJR+aLQYSWpb88GDJieAgR4g1XWZvUROQv1A=='
            crossorigin='anonymous' />

        <!-- import font awesome -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css'
            integrity='sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=='
            crossorigin='anonymous' />
        <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">

        <!-- import by ME -->
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/content-manage.css') }}">
        <!-- import by ME -->

    </head>

    <body>

        <!-- container start ----- -->
        <div class="container">

            <!-- Tabs start ----- -->
            <div class="tabs is-boxed ">
                <ul>
                    <li class="tab is-active" id="tab_1" contenteditable="true">
                        <a>
                            <span class="icon is-small">
                                <i class="fa-solid fa-hand-dots"></i>
                            </span>
                            <span> 皮膚科學 </span>
                        </a>
                    </li>
                    <li class="tab" id="tab_2" contenteditable="false">
                        <a>
                            <span class="icon is-small">
                                <i class="fa-solid fa-mask"></i>
                            </span>
                            <span> 保養新知 </span>
                        </a>
                    </li>
                    <li class="tab" id="tab_3" contenteditable="false">
                        <!-- <div class="field">
                            <input type="text" class="input is-static" value="醫學美容">
                        </div> -->
                        <a>
                            <span class="icon is-small">
                                <i class="fa-solid fa-book-medical"></i>
                            </span>
                            <span> 醫學美容 </span>
                        </a>
                    </li>
                </ul>
                <!-- 新增章節 btn -->
                {{-- <button class="button is-primary is-small is-outlined add-cat" id="addCatBtn">
                    <span class="icon is-small">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <span>新增章</span>
                </button>
                <button class="button is-small is-info">編輯</button>
                <button class="button is-small is-primary">保存</button>
                <button class="button is-small">取消</button>
                <!-- Search input -->
                <div class="field has-addons">
                    <div class="control">
                        <input class="input is-small" type="text" placeholder="輸入關鍵字">
                    </div>
                    <div class="control">
                        <button class="button is-info is-small">
                            <span class="icon is-small">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </button>
                    </div>
                </div>
                --}}
            </div>
            <!-- Tabs ends ------ -->

            <!-- tab-content start ----- -->
            <div class="tab-content">

                <div class="tab-container" id="tabContainer_1">
                    <!-- tab-element -->
                    <!-- <div class="tab-element">
                        <span class="keywords">
                            <a href="#">關鍵字</a>
                            <span class="tag is-light"> 40 </span>
                        </span>
                        <div class="tab-btns">
                            <button class="button is-small" type="button">
                                <span class="icon is-small">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </span>
                            </button>
                            <button class="button is-small" type="button">
                                <span class="icon is-small">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </span>
                            </button>
                            <button class="button is-small is-danger" type="button">
                                <span class="icon is-small">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                                <span>移除</span>
                            </button>
                        </div>
                    </div> -->
                </div>

                <div class="tab-container" id="tabContainer_2" hidden>
                </div>

                <div class="tab-container" id="tabContainer_3" hidden>

                </div>
                <form method="POST" action="{{route('chapter.hashtagCreate')}}" enctype="multipart/form-data" id="create_section">
                    @csrf
                    <div class="tab-element add-keyword">
                        <span class="keywords">
                            <div class="field">
                                <input class="input" type="text" placeholder="輸入關鍵字" id="addKeywordInput" name="keyword">
                                <p class="help is-danger hide" id="repeatInfo">
                                    重複建立關鍵字
                                </p>
                                <p class="help is-danger hide" id="emptyInfo">
                                    不可以空白
                                </p>
                                <p class="help is-danger hide" id="noDataInfo">
                                    資料庫無此關鍵字
                                </p>
                            </div>


                            <input type="hidden" name="chapter" value="1" id="chapter">
                            <button class="button is-primary" type="button" id="addKeywordBtn" name="section">
                                <span class="icon is-small">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                <span> 增加 </span>
                            </button>
                        </span>
                    </div>
                </form>

                <!-- tab-element add keyword-->


            </div>
            <!-- tab-content ends ------ -->

            <!-- tab-foot -->
            <div class="tab-foot">
                <!-- <div class="add-btn">
                    <button class="button is-primary is-outlined">
                        <span class="icon is-small">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                        <span> 新增小節 </span>
                    </button>
                </div> -->
                <div class="save-btns">
                    <button class="button is-primary" type="button" id="saveChangeBtn">套用變更</button>
                    <button class="button" type="button">取消</button>
                </div>
            </div>


        </div>
        <!-- container ends ------ -->





        <script src="{{asset('javascript/content-manage.js')}}"></script>
    </body>

</html>
