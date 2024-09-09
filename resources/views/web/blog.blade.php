
@extends('web.layout.master')
@section('content')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Blog</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="blog-page-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="single-blog">
                    <div class="blog-thumb">
                        <a href="javascript:void(0)"><img src="{{asset('assets/web')}}/asset/img/large-blog-1.jpg" alt=""></a>
                    </div>
                    <a href="javascript:void(0)" class="blog-title">Looked up one of the more obscure batin</a>
                    <ul class="postmeta">        
                        <li><span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published">January 26, 2018</time></a></span></li>
                        <li><span>by</span><a href="#">loanplus</a></li>
                        <li><a href="#" class="loanplus-comment">No Comment</a></li>
                    </ul>
                    
                    <p>The passages of Lorem Ipsum available but the majority ave suffered alteration embarrased the point of using rem 
                    distribution Ipsum available but the majority ave suffered...</p>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">Read More</a>
                </div>
                <div class="single-blog">
                    <div class="blog-thumb">
                        <a href="javascript:void(0)"><img src="{{asset('assets/web')}}/asset/img/large-blog-2.jpg" alt=""></a>
                    </div>
                    <a href="javascript:void(0)" class="blog-title">The cites of the word in classical literature</a>
                    <ul class="postmeta">        
                        <li><span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published">January 24, 2018</time></a></span></li>
                        <li><span>by</span><a href="#">loanplus</a></li>
                        <li><a href="#" class="loanplus-comment">No Comment</a></li>
                    </ul>
                    <p>The passages of Lorem Ipsum available but the majority ave suffered alteration embarrased the point of using rem distribution Ipsum available but the majority ave suffered...</p>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">Read More</a>
                </div>
                <div class="single-blog">
                    <div class="blog-thumb">
                        <a href="javascript:void(0)"><img src="{{asset('assets/web')}}/asset/img/large-blog-3.jpg" alt=""></a>
                    </div>
                    <a href="javascript:void(0)" class="blog-title">Many desktop publishing packages and web page</a>
                    <ul class="postmeta">        
                        <li><span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published">January 23, 2018</time></a></span></li>
                        <li><span>by</span><a href="#">loanplus</a></li>
                        <li><a href="#" class="loanplus-comment">No Comment</a></li>
                    </ul>

                    <p>The passages of Lorem Ipsum available but the majority ave suffered alteration embarrased the point of using rem distribution Ipsum available but the majority ave suffered...</p>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">Read More</a>
                </div>
                <div class="single-blog">
                    <div class="blog-thumb">
                        <a href="javascript:void(0)"><img src="{{asset('assets/web')}}/asset/img/large-blog-4.jpg" alt=""></a>
                    </div>
                    <a href="javascript:void(0)" class="blog-title">Handful of model sentence structures, to generate</a>
                    <ul class="postmeta">        
                        <li><span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published">January 22, 2018</time></a></span></li>
                        <li><span>by</span><a href="#">loanplus</a></li>
                        <li><a href="#" class="loanplus-comment">No Comment</a></li>
                    </ul>

                    <p>The passages of Lorem Ipsum available but the majority ave suffered alteration embarrased the point of using rem distribution Ipsum available but the majority ave suffered...</p>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">Read More</a>
                </div>
                <div class="single-blog">
                    <div class="blog-thumb">
                        <a href="javascript:void(0)"><img src="{{asset('assets/web')}}/asset/img/large-blog-5.jpg" alt=""></a>
                    </div>
                    <a href="javascript:void(0)" class="blog-title">Various versions have evolved over the years</a>
                    <ul class="postmeta">        
                        <li><span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published">January 20, 2018</time></a></span></li>
                        <li><span>by</span><a href="#">loanplus</a></li>
                        <li><a href="#" class="loanplus-comment">No Comment</a></li>
                    </ul>
                      <p>The passages of Lorem Ipsum available but the majority ave suffered alteration embarrased the point of using rem distribution Ipsum available but the majority ave suffered...</p>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">Read More</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
    <span aria-hidden="true">«</span>
    <span class="sr-only">Previous</span>
  </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
    <span aria-hidden="true">»</span>
    <span class="sr-only">Next</span>
  </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar-area">
                    <div class="single-sidebar">
                        <div class="sidebar-searchbox">
                            <form action="#" method="get">
                                <input type="text" name="s" placeholder="Search...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <h4 class="sidebar-title">Categories</h4>
                        <ul>
                            <li><a href="#">Business Loan</a></li>
                            <li><a href="#">Personal Loan</a></li>
                            <li><a href="#">Raw Material Financing</a></li>
                            <li><a href="#">Receivables Invoicing</a></li>
                        </ul>
                    </div>
                    <div class="single-sidebar">
                        <h4 class="sidebar-title">Latest Post</h4>
                        <ul class="latest-post">
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="post-img">
                                        <img src="{{asset('assets/web')}}/asset/img/post.jpg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>This book is a treatise ong ethics very popular.</h5>
                                        <div class="date">
                                            January 18, 2018
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="post-img">
                                        <img src="{{asset('assets/web')}}/asset/img/post-2.jpg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>This book is a treatise ong ethics very popular.</h5>
                                        <div class="date">
                                            January 18, 2018
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="post-img">
                                        <img src="{{asset('assets/web')}}/asset/img/post-3.jpg" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h5>This book is a treatise ong ethics very popular.</h5>
                                        <div class="date">
                                            January 18, 2018
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="single-sidebar">
                        <h4 class="sidebar-title">Archives</h4>
                        <ul>
                            <li><a href="#">December 2017</a></li>
                            <li><a href="#">January 2018</a></li>
                            <li><a href="#">February 2018</a></li>
                        </ul>
                    </div>
                    <div class="single-sidebar">
                        <h4 class="sidebar-title">tags</h4>
                        <div class="tagcloud">
                            <a href="#">Loan</a>
                            <a href="#">document</a>
                            <a href="#">business</a>
                            <a href="#">personal</a>
                            <a href="#">apply</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection