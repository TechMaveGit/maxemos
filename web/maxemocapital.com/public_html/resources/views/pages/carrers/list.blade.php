@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">Career Posts</div>

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
                    <li>Career Posts</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">Career Posts</div>
            <div class="btns_rightimport">
                <a href="{{route('careerAdd')}}"
                        class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Add New
                </a>
            </div>
        </div>

        <div class="table_mainstart" id="sc_table">
            <div class="row">
                <div class="col-lg-12">
                    <div>

                        <div class="card mt-3">
                            <div
                                class="is-scrollbar-hidden min-w-full overflow-x-auto"
                                x-data="pages.tables.initExample1"
                            >
                                <table class="is-hoverable w-full text-left faq_table" >
                                    <thead>
                                    <tr>
                                        <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            S.No.
                                        </th>

                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Title
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Location
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Positions
                                        </th>

                                        <th
                                            class="whitespace-nowrap rounded-tr-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($allcareers)
                                            @foreach ($allcareers as $career)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $career->title }}</td>
                                                    <td>{{ $career->location }}</td>
                                                    <td>{{ $career->no_of_postions }}</td>
                                                    <td> <a class="btn btn-sm btn-info" href="{{ route('careerEdit',['id'=>$career->id]) }}">Edit</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    
                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- table end -->
        </section>
    </main>

@endsection

