@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">Privacy Policy</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:voide(0);">Important Links</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">Privacy Policy</div>
            <div class="btns_rightimport">

            </div>
        </div>

        <section class="questionansser">
            <div class="row">
                <div class="col-lg-12">
                    <div class="question_card card">
                        <form id="actionForm" method="post" action="{{route('savePrivacyPolicy')}}">
                            @csrf

                            <div class="form-group">
                                <textarea name="privacyPolicy" id="privacyPolicy" class="form-control" rows="10" ><?=$settings->privacyPolicy?></textarea>
                            </div>

                            <div class="modal-footer mt-3">
                                <button type="submit" id="formSubmitBtn" onclick="$('#actionForm').submit();$('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
@section('scripts')
    <script>
        CKEDITOR.replace( 'privacyPolicy' );
    </script>
@endsection

