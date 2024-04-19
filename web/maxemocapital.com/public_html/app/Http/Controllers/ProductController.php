<?php

namespace App\Http\Controllers;

use App\Models\CreditScoreQuestionAnswer;
use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Models\User;
use App\Models\EmploymentHistory;
use App\Models\UserBankDetail;
use App\Models\UserDoc;
use App\Models\UserOtp;
use App\Models\ApplyLoanHistory;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Tenure;
use Auth;
use DB;

class ProductController extends Controller
{
    public function __construct(){
        AppServiceProvider::checkUserLogin();
    }

    public function categoryList()
    {
        $isValidated=AppServiceProvider::validatePermission('category-list');
        $pageTitle='Product Category';
        $pageNameStr='product-category';
        $category=Category::all();
        return view('pages.product-management.product-category',compact('category','pageNameStr','pageTitle'));
    }

    public function saveCategory(Request $request)
    {
        $recordId=$request->recordId;
        if($recordId>0){
            $isValidated=AppServiceProvider::validatePermission('edit-category');
        }else{
            $isValidated=AppServiceProvider::validatePermission('add-category');
        }

        // $image='';
        // if(!empty($request->myDropify)){
        //     $image=AppServiceProvider::uploadImageCustom('myDropify','products');
        // }

        if($recordId)
        {
            $updateArr['name']=$request->catName;
            $updateArr['description']=$request->catDesc;
            // if($image){
            //     $updateArr['image']=$image;
            // }
            $save=Category::where('id',$recordId)->update($updateArr);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Category details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            $obj=new Category();
            $obj->name=$request->catName;
            $obj->description=$request->catDesc;
            // $obj->image=$image;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Category has been saved successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }
    }


    public function tenureList()
    {
        $isValidated=AppServiceProvider::validatePermission('tenure-list');
        
        $pageTitle='Tenure List';
        $pageNameStr='tenure-list';
        $category=DB::select("SELECT * FROM categories WHERE status=1 ORDER BY name asc");


        

        return view('pages.product-management.tenure-master',compact('category','pageNameStr','pageTitle'));
    }
    
    public function filterTenureList(Request $request)
    {
        $catId=$request->catId;
        
        $SUBQRY=($catId) ? " AND t.loanCategory='$catId'" : "";
        $tenures=DB::select("SELECT t.*,c.name as categoryName FROM tenures t LEFT JOIN categories c ON t.loanCategory=c.id  WHERE c.status=1 $SUBQRY ORDER BY t.sortOrder asc");
       
            $TBLLTHCLS='whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
            $htmlStr ='<table id="mainTbl" class="is-hoverable w-full text-left dataTable no-footer">
                    <thead>
                      <tr>
                       <th '.$TBLLTHCLS.'>S.No.</th>
                            <th '.$TBLLTHCLS.'>Category Name</th>
                            <th '.$TBLLTHCLS.'>Tenure</th>
                            <th '.$TBLLTHCLS.'>Tenure Months/Year</th>
                            <th '.$TBLLTHCLS.'>No. Of EMIs</th>
                            <th '.$TBLLTHCLS.'>Sort Order</th>
                            <th '.$TBLLTHCLS.'>Action</th>
                      </tr>
                    </thead>
                    <tbody>';
            $srn=1;
            foreach ($tenures as $crow)
            {

                $buttons='';

                $buttons .='<a href="javascript:void(0);" id="editInputs'.$crow->id.'" onclick="setInputs('.$crow->id.');"  data-name="'.$crow->name.'" data-loanCategory="'.$crow->loanCategory.'" data-sortOrder="'.$crow->sortOrder.'" data-numOfEmis="'.$crow->numOfEmis.'" data-numOfMonths="'.$crow->numOfMonths.'" class="btn btn-primary" ><i class="fa fa-pencil"></i> </a>';


                $htmlStr .='<tr>
                                <td>'.$srn.'</td>
                                <td>'.$crow->categoryName.'</td>
                                <td>'.$crow->name.'</td>
                                <td>'.$crow->numOfMonths.'</td>
                                <td>'.$crow->numOfEmis.'</td>
                                <td>'.$crow->sortOrder.'</td>
                                <td>'.$buttons.'</td>
                            </tr>';
                $srn++;
            }

            $htmlStr .='</tbody>
                    </table>';
            echo $htmlStr;
    }

    public function saveTenureDetails(Request $request)
    {
        $recordId=$request->recordId;
        if($recordId>0){
            $isValidated=AppServiceProvider::validatePermission('edit-tenure');
        }else{
            $isValidated=AppServiceProvider::validatePermission('add-tenure');
        }

        
        if($recordId)
        {
            $updateArr['loanCategory']=$request->loanCategory;
            $updateArr['name']=$request->tenureTitle;
            $updateArr['numOfMonths']=$request->numOfMonths;
            $updateArr['sortOrder']=$request->sortOrder;
            $updateArr['numOfEmis']=$request->numOfEmis;
           
            $save=Tenure::where('id',$recordId)->update($updateArr);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Tenure details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            $obj=new Tenure();
            $obj->loanCategory=$request->loanCategory;
            $obj->name=$request->tenureTitle;
            $obj->numOfMonths=$request->numOfMonths;
            $obj->sortOrder=$request->sortOrder;
            $obj->numOfEmis=$request->numOfEmis;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Tenure details has been saved successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }
    }

    public function deleteCategory(Request $request)
    {
        $isValidated=AppServiceProvider::validatePermission('delete-category');
        $save=Category::where('id',$request->recordId)->delete();
        if($save){
            echo json_encode(['status'=>'success','message'=>'Category has been deleted successfully.']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }

    public function subCategoryList()
    {
        $category=Category::where('status',1)->get();
        $subcategory=DB::select("SELECT sc.*,c.name as categoryName FROM subcategories sc LEFT JOIN categories c ON sc.categoryId=c.id ORDER BY sc.name ASC");
        return view('pages.product-management.product-subcategory',compact('subcategory','category'));
    }

    public function saveSubCategory(Request $request)
    {
        $recordId=$request->recordId;
        if($recordId>0){
            $isValidated=AppServiceProvider::validatePermission('edit-sub-category');
        }else{
            $isValidated=AppServiceProvider::validatePermission('add-sub-category');
        }

        if($recordId)
        {
            $save=Subcategory::where('id',$recordId)->update(['name'=>$request->catName,'categoryId'=>$request->parentCat]);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Sub-Category details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            $obj=new Subcategory();
            $obj->name=$request->catName;
            $obj->categoryId=$request->parentCat;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Sub-Category has been saved successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }
    }

    public function deleteSubCategory(Request $request)
    {
        $isValidated=AppServiceProvider::validatePermission('delete-sub-category');
        $save=Subcategory::where('id',$request->recordId)->delete();
        if($save){
            echo json_encode(['status'=>'success','message'=>'Sub-Category has been deleted successfully.']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }

    public function productsByRange()
    {
        $tenure=CreditScoreQuestionAnswer::where('questionId',3)->where('status',1)->select('id','ansTitle','otherValueOrDays')->get();
        $tenureArr=[];
        if(count($tenure))
        {
            foreach ($tenure as $trow)
            {
                $tenureArr[$trow->id]=$trow->ansTitle;
            }
        }

        $products=Product::where('productType',1)->get();

        return view('pages.product-management.create-product-by-range',compact('products','tenure','tenureArr'));
    }

    public function saveProductByRange(Request $request)
    {
        $recordId=$request->recordId;
        if($recordId>0){
            $isValidated=AppServiceProvider::validatePermission('add-product-by-range');
        }else{
            $isValidated=AppServiceProvider::validatePermission('edit-product-by-range');
        }
        if($recordId)
        {
            /*
            $productCode=$request->productCode;
            $prod=DB::select("SELECT * FROM products WHERE productCode ='$productCode' and id !='$recordId'");
            if(count($prod)){
                echo json_encode(['status'=>'error','message'=>'This product id is already registered with us.']); exit;
            }
            */

                $updateArr=['productName'=>$request->productName,
                'amount'=>$request->amount,
                'amountTo'=>$request->amountTo,
                'tenure'=>$request->tenure,
                'numOfEmi'=>$request->numOfEmi,
                'rateOfInterest'=>$request->rateOfInterest,
                'gst'=>$request->gst,
                'premium'=>0,
                'processingFee'=>0,
                'insurance'=>$request->insurance,
                'verificationCharges'=>$request->verificationCharges,
                'collectionFee'=>0,
                'plateformFee'=>$request->plateformFee,
                'convenienceFee'=>0,
                'principleAmount'=>$request->principleAmount,
                'pfPercentage'=>$request->pfPercentage];
            $save=Product::where('id',$recordId)->update($updateArr);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Product details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            $prod=Product::where('productCode',$request->productCode)->first();
            if(!empty($prod)){
                echo json_encode(['status'=>'error','message'=>'This product id is already registered with us.']); exit;
            }

            $productType=1;
            $productCode=$this->generateProductCode($productType);

            $obj=new Product();
            $obj->productCode=$productCode;
            $obj->productName=$request->productName;
            $obj->amount=$request->amount;
            $obj->amountTo=$request->amountTo;
            $obj->tenure=$request->tenure;
            $obj->numOfEmi=$request->numOfEmi;
            $obj->rateOfInterest=$request->rateOfInterest;
            $obj->gst=$request->gst;
            $obj->premium=$request->premium;
            $obj->processingFee=$request->processingFee;
            $obj->insurance=$request->insurance;
            $obj->verificationCharges=$request->verificationCharges;
            $obj->collectionFee=$request->collectionFee;
            $obj->plateformFee=$request->plateformFee;
            $obj->convenienceFee=0;
            $obj->principleAmount=$request->principleAmount;
            $obj->productType=$productType;
            $obj->pfPercentage=$request->pfPercentage;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Product details has been saved successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }
    }

    public function productsByCategory()
    {

        $isValidated=AppServiceProvider::validatePermission('product-by-category-list');

        $pageTitle='Products List';
        $pageNameStr='product-list';

        $category=Category::where('status',1)->get();
        $tenure=Tenure::where('status',1)->orderBy('numOfMonths','asc')->get();
        $products=DB::select("SELECT p.*,c.name as categoryName,t.name as tenureName FROM products p LEFT JOIN categories c ON p.categoryId=c.id LEFT JOIN tenures t ON p.tenure=t.id ORDER BY p.productName ASC");
        return view('pages.product-management.create-product-by-category',compact('products','pageTitle','pageNameStr','category','tenure'));
    }

    public function getSubCategoryByCatId(Request $request)
    {
        $htmlStr='<option value="">Select</option>';
        $categoryId=$request->categoryId;
        $subCategory=Subcategory::where('categoryId',$categoryId)->orderBy('name','asc')->get();
        if(count($subCategory)){
            foreach ($subCategory as $subr)
            {
                $htmlStr .='<option value="'.$subr->id.'">'.$subr->name.'</option>';
            }
        }

        echo json_encode(['status'=>'success','message'=>'Sub-Category List','data'=>$htmlStr]); exit;
    }

    public function saveProductByCategory(Request $request)
    {
        $recordId=$request->recordId;
        if($recordId>0){
            $isValidated=AppServiceProvider::validatePermission('add-product-by-category');
        }else{
            $isValidated=AppServiceProvider::validatePermission('edit-product-by-category');
        }

        if($recordId)
        {
            /*
            $productCode=$request->productCode;
            $prod=DB::select("SELECT * FROM products WHERE productCode ='$productCode' and id !='$recordId'");
            if(count($prod)){
                echo json_encode(['status'=>'error','message'=>'This product id is already registered with us.']); exit;
            }
            */

            //$upArr['productCode']=$request->productCode;
            $upArr['productName']=$request->productName;
            $upArr['categoryId']=$request->categoryId;
            //$upArr['subCategoryId']=$request->subCategoryId;
            $upArr['tenure']=$request->tenure;
            //$upArr['amount']=$request->amount;
            //$upArr['numOfEmi']=$request->numOfEmi;
            $upArr['description']=$request->description;

            $upArr['rateOfInterest']=$request->rateOfInterest;
            //$upArr['gst']=$request->gst;
            //$upArr['premium']=$request->premium;
            //$upArr['processingFee']=$request->processingFee;
            //$upArr['insurance']=$request->insurance;
            //$upArr['verificationCharges']=$request->verificationCharges;
            //$upArr['collectionFee']=$request->collectionFee;
            //$upArr['plateformFee']=$request->plateformFee;
            //$upArr['convenienceFee']=0;
            //$upArr['principleAmount']=$request->principleAmount;

            $image='';
            if(!empty($request->myDropify)){
                $image=AppServiceProvider::uploadImageCustom('myDropify','products');
                $upArr['image']=$image;
            }

            $save=Product::where('id',$recordId)->update($upArr);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Product details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            $prod=Product::where('productCode',$request->productCode)->first();
            if(!empty($prod)){
                echo json_encode(['status'=>'error','message'=>'This product id is already registered with us.']); exit;
            }

            $image='';
            if(!empty($request->myDropify)){
                $image=AppServiceProvider::uploadImageCustom('myDropify','products');
            }

            $productType=0;
            $productCode=$this->generateProductCode($productType);

            $obj=new Product();
            $obj->productCode=$productCode;
            $obj->productName=$request->productName;
            $obj->categoryId=$request->categoryId;
            //$obj->subCategoryId=$request->subCategoryId;
            $obj->tenure=$request->tenure;
            //$obj->numOfEmi=$request->numOfEmi;
            //$obj->amount=$request->amount;
            $obj->description=$request->description;
            $obj->rateOfInterest=$request->rateOfInterest;
            //$obj->gst=$request->gst;
            //$obj->premium=$request->premium;
            //$obj->processingFee=$request->processingFee;
            //$obj->insurance=$request->insurance;
            //$obj->verificationCharges=$request->verificationCharges;
            //$obj->collectionFee=$request->collectionFee;
            //$obj->plateformFee=$request->plateformFee;
            //$obj->convenienceFee=0;
            //$obj->principleAmount=$request->principleAmount;
            $obj->image=$image;
            //$obj->productType=$productType;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Product details has been saved successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }
    }

    public function generateProductCode($productType)
    {
        $PRO_PREFIX='PRO';
        $customerRes=DB::select("select id,productCode as customerCode from products where productCode IS NOT NULL AND productCode !='' order by id desc limit 1");
        if(count($customerRes)){
            $customerCodeOld=$customerRes[0]->customerCode;
            $customerCodeOldNew=(int)str_replace($PRO_PREFIX,'',$customerCodeOld);
            if($customerCodeOldNew<10){
                $customerCodeInt=$customerCodeOldNew+1;
                $customerCode=$PRO_PREFIX.'0000'.$customerCodeInt;
            }else if($customerCodeOldNew<100){
                $customerCodeInt=$customerCodeOldNew+1;
                $customerCode=$PRO_PREFIX.'000'.$customerCodeInt;
            }else if($customerCodeOldNew<1000){
                $customerCodeInt=$customerCodeOldNew+1;
                $customerCode=$PRO_PREFIX.'00'.$customerCodeInt;
            }else if($customerCodeOldNew<10000){
                $customerCodeInt=$customerCodeOldNew+1;
                $customerCode=$PRO_PREFIX.'0'.$customerCodeInt;
            }else{
                $customerCodeInt=$customerCodeOldNew+1;
                $customerCode=$PRO_PREFIX.$customerCodeInt;
            }
        }else{
            $customerCode=$PRO_PREFIX.'00001';
        }
        return $customerCode;
    }

    public function updateProductStatusMaster(Request $request)
    {
        $recordId=$request->recordId;
        $status=$request->status;

        $isValidated=AppServiceProvider::validatePermission('product-activation');

        $save=Product::where('id',$recordId)->update(['status'=>$status]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Product status has been changed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function updateCategoryStatusMaster(Request $request)
    {
        $recordId=$request->recordId;
        $status=$request->status;

        $isValidated=AppServiceProvider::validatePermission('category-activation');

        $save=Category::where('id',$recordId)->update(['status'=>$status]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Category status has been changed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function updateSubCategoryStatusMaster(Request $request)
    {
        $recordId=$request->recordId;
        $status=$request->status;

        $save=Subcategory::where('id',$recordId)->update(['status'=>$status]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Sub Category status has been changed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }
}
