@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">Career New Post</div>

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
            <div class="common_pagetitlebig">Career New Post</div>
            <div class="btns_rightimport">
            </div>
        </div>

        <section class="questionansser">
            <div class="row">
                <div class="col-lg-12">
                    <div class="question_card card">
                        <form id="actionForm" method="post" action="{{route('careerAdd')}}">
                            @csrf
                            <div class="row m-3">
                                <div class="col-lg-4 my-2">
                                    <label class="block">
                                        <span>Post Title</span>
                                        <input id="title" name="title" value="{{ old('title') }}" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Career Post Title" type="text">
                                        @error('title')
                                        <span class="text-danger">{{$message}}</span>    
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-lg-4 my-2">
                                    <label class="block">
                                        <span>Total Position Open</span>
                                        <input id="no_of_postions" name="no_of_postions" value="{{ old('no_of_postions') }}" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Opening Positions" type="number">
                                        @error('no_of_postions')
                                        <span class="text-danger">{{$message}}</span>    
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-lg-4 my-2">
                                    <label class="block">
                                        <span>Location</span>
                                        <input id="joblocation" name="joblocation" value="{{ old('joblocation') }}" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Your Location" type="text">
                                        @error('joblocation')
                                        <span class="text-danger">{{$message}}</span>    
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-12 my-2">
                                    <div class="form-group">
                                        <label class="block">
                                            <span>Career In Details (Job description)</span>
                                        <textarea name="description" id="description" class="form-control" rows="10" >{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{$message}}</span>    
                                            @enderror
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="block">
                                        <span>Start Date</span>
                                        <input id="jobStartDate" name="jobStartDate" value="{{ old('jobStartDate') }}" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Your Location" type="date">
                                        @error('jobStartDate')
                                        <span class="text-danger">{{$message}}</span>    
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="block">
                                        <span>End Date</span>
                                        <input id="jobEndDate" name="jobEndDate" value="{{ old('jobEndDate') }}" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter Your Location" type="date">
                                        @error('jobEndDate')
                                        <span class="text-danger">{{$message}}</span>    
                                        @enderror
                                    </label>
                                </div>

                            </div>
                            

                            <div class="modal-footer mt-3">
                                <button type="submit"  class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save</button>
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
        CKEDITOR.replace('description');
    </script>
@endsection


