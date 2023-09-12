<?php

namespace Engage\Downloadcenter\Http\Controllers;

use DB;
use Storage;
use Response;
use Carbon\Carbon;
use App\Models\User;
use DirectoryIterator;
use App\Models\Tenant;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Engage\Downloadcenter\Models\File_download_history;
use Engage\Downloadcenter\Models\ProductPermissions;
use Engage\Downloadcenter\Models\Products;
use Engage\Downloadcenter\Models\TenantFileAccess;


class TenantFileAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $tenant_list = Tenant::where('account_status',1)->orderBy('company_name')->get();
            //$release_list = Products::select('product_version')->distinct()->get()->pluck('product_version')->toArray();
			//Add orderBy
            $release_list = Products::select('product_version')->distinct()->orderBy('product_version')->get()->pluck('product_version')->toArray();
            return view('engage_downloadcenter::TenantFileAccess.Admin.index',compact('tenant_list','release_list'));
        }else{

            //$release_list = Products::join('product_permissions', 'products.id', '=', 'product_permissions.product_id')->select('product_version')->distinct()->where('product_permissions.tenant_id',tenant('tenant_id'))->pluck('product_version')->toArray();
            // Add orderBy
			$release_list = Products::join('product_permissions', 'products.id', '=', 'product_permissions.product_id')->select('product_version')->distinct()->orderBy('product_version')->where('product_permissions.tenant_id',tenant('tenant_id'))->pluck('product_version')->toArray();
            return view('engage_downloadcenter::TenantFileAccess.Users.index',compact('release_list'));
        }
    }

    public function getProduct(Request $request)
    {
        $product_list = Products::product_list($request->product_version);
        return $product_list;
    }

    public function fileList(Request $request)
    {

        $filelist = [];
        $access = false;
        $subfolder = false;
        if(Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN){
            $permission = ProductPermissions::checkPermissions($request->product_id, $request->tenant_id);
        }else{
            $permission = ProductPermissions::checkPermissions($request->product_id, tenant('tenant_id'));
        }

        if($request->tenant_id == 0 || !is_null($permission)){
            $product = Products::where(['id' => $request->product_id])->first();
            if(!is_null($product)){
                if(!empty($request->subfolder) && $request->subfolder != false && $request->subfolder != "false"){
                    $path = TenantFileAccess::getFilePath($product->product_version.'/'.$product->product_name.'/'.$request->subfolder.'/');

                    $subfolder = $request->subfolder;
                }else{
                    $path = TenantFileAccess::getFilePath($product->product_version.'/'.$product->product_name.'/');
                }
                if($path){
                    $filelist = self::dir_contents_recursive($path);
                }

                $access = true;
            }
        }

        if($request->tenant_id == 0 && Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN){
            $privilege = 'all';
        }elseif(!is_null($permission) && Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN){
            $privilege = 'granted';
        }elseif(Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN){
            $privilege = 'notGranted';
        }else{
            $privilege = 'user';
        }
        $product_id = $request->product_id;

        return response()->json([
            'is_success' => true,
            'data' => view('engage_downloadcenter::TenantFileAccess.Admin.file_list',compact('filelist','privilege','access','product_id','subfolder'))->render(),
        ]);
    }

    public function fileAccess(Request $request)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $permission = ProductPermissions::checkPermissions($request->product_id, $request->tenant_id);
            if(is_null($permission)){
                if(!empty($request->product_id) && !empty($request->tenant_id) && $request->tenant_id != 0){
                    ProductPermissions::create([
                        'product_id' => $request->product_id,
                        'tenant_id' => $request->tenant_id,
                        'created_by' => Auth::user()->id,
                    ]);
                    return response()->json([
                        'is_success' => true,
                        'message' => __('Permission assigned successfully.'),
                    ]);
                }else{
                    return response()->json([
                        'is_success' => false,
                        'message' => __('Something went wrong.'),
                    ]);
                }
            }else{
                return response()->json([
                    'is_success' => false,
                    'message' => __('Permission already exist.'),
                ]);
            }
        }else{

            return response()->json([
                'is_success' => false,
                'message' => __('Permission Denied.'),
            ]);
        }
    }

    public function removeFileAccess(Request $request)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $permission = ProductPermissions::checkPermissions($request->product_id, $request->tenant_id);
            if(!is_null($permission)){
                if(!empty($request->product_id) && !empty($request->tenant_id) && $request->tenant_id != 0){
                    $permission->delete();
                    return response()->json([
                        'is_success' => true,
                        'message' => __('Permission removed successfully.'),
                    ]);
                }else{
                    return response()->json([
                        'is_success' => false,
                        'message' => __('Something went wrong.'),
                    ]);
                }
            }else{
                return response()->json([
                    'is_success' => false,
                    'message' => __('Permission not exist.'),
                ]);
            }
        }else{

            return response()->json([
                'is_success' => false,
                'message' => __('Permission Denied.'),
            ]);
        }
    }

    public function newRelease()
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            return view('engage_downloadcenter::TenantFileAccess.Admin.new_release');
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function storeNewRelease(Request $request)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {

            $rules = [
                'release_name' => 'required',
                'product_name' => 'required',
            ];

            $validator = Validator::make(
                $request->all(),
                $rules
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->getMessageBag()->first());
            }

            $checkCombination = Products::where(['product_version' => $request->release_name, 'product_name' => $request->product_name])->first();

            if (!is_null($checkCombination)) {
                return redirect()->back()->with('error', 'This Release and Product already exist.');
            }

            $product = Products::create([
                'product_version'    => $request->release_name,
                'product_name'     => $request->product_name,
                'created_by'  => Auth::user()->id,
            ]);

            $release_folder = false;

            $product_folder = false;

            if(!is_null($product)){

                $releasePath = $product->product_version;

                $release_folder = TenantFileAccess::createDirectory($releasePath);

                if($release_folder){
                    $productPath = $product->product_version.'/'.$product->product_name;

                    $product_folder = TenantFileAccess::createDirectory($productPath);
                }
            }

            if(!is_null($product) && $release_folder && $product_folder){
                return redirect()->back()->with('success', __('Release and Product created successfully.'))->with('product',$product->id)->with('release',$product->product_version)->with('tenant',$request->tenant);
            }else{
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function newProduct()
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $releases = Products::select('product_version')->distinct()->get()->pluck('product_version')->toArray();
            return view('engage_downloadcenter::TenantFileAccess.Admin.new_product',compact('releases'));
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function storeNewProduct(Request $request)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {

            $rules = [
                'release_name' => 'required',
                'product_name' => 'required',
            ];

            $validator = Validator::make(
                $request->all(),
                $rules
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->getMessageBag()->first());
            }

            $checkCombination = Products::where(['product_version' => $request->release_name, 'product_name' => $request->product_name])->first();

            if (!is_null($checkCombination)) {
                return redirect()->back()->with('error', 'This Release and Product already exist.');
            }

            $product = Products::create([
                'product_version'    => $request->release_name,
                'product_name'     => $request->product_name,
                'created_by'  => Auth::user()->id,
            ]);

            $release_folder = false;

            $product_folder = false;

            if(!is_null($product)){

                $releasePath = $product->product_version.'/';

                $release_folder = TenantFileAccess::createDirectory($releasePath);

                if($release_folder){
                    $productPath = $product->product_version.'/'.$product->product_name.'/';

                    $product_folder = TenantFileAccess::createDirectory($productPath);
                }
            }

            if(!is_null($product) && $release_folder && $product_folder){
                return redirect()->back()->with('success', __('Product created successfully.'))->with('product',$product->id)->with('release',$product->product_version)->with('tenant',$request->tenant);
            }else{
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function editReleaseProduct($id)
    {
        error_log(">>>> editReleaseProduct");
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $product = Products::where(['id' => $id])->first();
            if(!is_null($product)){
                return view('engage_downloadcenter::TenantFileAccess.Admin.edit_release_product',compact('product'));
            }else{
                return redirect()->back()->with('error', __('Product does not exist.'));
            }
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function updateReleaseProduct(Request $request,$id)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {

            $rules = [
                'release_name' => 'required',
                'product_name' => 'required',
            ];

            $validator = Validator::make(
                $request->all(),
                $rules
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->getMessageBag()->first());
            }

            $checkCombination = Products::where(['product_version' => $request->release_name, 'product_name' => $request->product_name])->whereNotIn('id',[$id])->first();

            if (!is_null($checkCombination)) {
                return redirect()->back()->with('error', 'This Release and Product already exist.');
            }

            $product = Products::where('id',$id)->first();

            $release_folder = false;

            $product_folder = false;

            if(!is_null($product)){
                $release_name = $product->product_version;
                $product_name = $product->product_name;
                $product->product_version = $request->release_name;
                $product->product_name = $request->product_name;
                $product->save();

                Products::where(['product_version' => $release_name])->update(['product_version' => $request->release_name]);

                if(!is_null($product)){
                    $productOldPath = $release_name.'/'.$product_name;
                    $productNewPath = $release_name.'/'.$product->product_name;
                    $product_folder = TenantFileAccess::renameFile($productOldPath, $productNewPath);

                    $releaseOldPath = $release_name;
                    $releaseNewPath = $product->product_version;
                    $release_folder = TenantFileAccess::renameFile($releaseOldPath, $releaseNewPath);
                }

                if(!is_null($product) && $release_folder && $product_folder){
                    return redirect()->back()->with('success', __('Release and Product Updated successfully.'))->with('product',$product->id)->with('release',$product->product_version)->with('tenant',$request->tenant);
                }else{
                    return redirect()->back()->with('error', __('Something went wrong.'));
                }
            }else{
                return redirect()->back()->with('error', __('Product does not exist.'));
            }
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function newFile($id,$type,$name = false)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $product = Products::where('id',$id)->first();
            if(!is_null($product)){
                $product->subfolder = '';
                if($type == "folder"){
                    $product->type = "folder";
                }else{
                    $product->type = "file";
                    if(!empty($name) && $name != false){
                        $product->subfolder = $name;
                    }
                }
                return view('engage_downloadcenter::TenantFileAccess.Admin.new_file_folder',compact('product'));
            }else{
                return redirect()->back()->with('error', __('Product Not Found.'));
            }
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function storeNewFile(Request $request)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {

            $product = Products::where('id',$request->product_id)->first();

            if(!is_null($product)){
                if($request->type == "folder"){
                    if(empty($request->folder_name)){
                        return redirect()->back()->with('error', __('Please enter valid folder name.'));
                    }else{
                        $folderPath = $product->product_version.'/'.$product->product_name.'/'.$request->folder_name.'/';

                        $folder = TenantFileAccess::createDirectory($folderPath);

                        if($folder){
                            return redirect()->back()->with('success', __('Folder created successfully.'))->with('product',$product->id)->with('release',$product->product_version)->with('tenant',$request->tenant);
                        }else{
                            return redirect()->back()->with('error', __('Something went wrong.'));
                        }
                    }
                }else{

                    $folderPath = $product->product_version.'/'.$product->product_name.'/'.$request->folder_name.'/';
                    if($request->hasFile('file')){
                        if(!empty($request->subfolder) && $request->subfolder != false && $request->subfolder != "false"){
                            $filePath = TenantFileAccess::getFilePath($product->product_version.'/'.$product->product_name.'/'.$request->subfolder.'/');
                            $subfolder = $request->subfolder;
                        }else{
                            $filePath = TenantFileAccess::getFilePath($product->product_version.'/'.$product->product_name.'/');
                            $subfolder = '';
                        }

                        if($filePath){

                            try{

                                $fileName = $request->file('file')->getClientOriginalName();

                                // create the file receiver
                                $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

                                // check if the upload is success, throw exception or return response you need
                                if ($receiver->isUploaded() === false) {
                                    throw new UploadMissingFileException();
                                }

                                // receive the file
                                $save = $receiver->receive();

                                // check if the upload has finished (in chunk mode it will send smaller files)
                                if ($save->isFinished()) {
                                    // save the file and return any response you need, current example uses `move` function. If you are
                                    // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())

                                    return $this->saveFile($save->getFile(), $filePath, $fileName, $subfolder);
                                }

                                // we are in chunk mode, lets send the current progress
                                /** @var AbstractHandler $handler */
                                $handler = $save->handler();

                                return response()->json([
                                    "done" => $handler->getPercentageDone(),
                                    "status" => true,
                                    "is_success" => true,
                                    "message" =>  __('File uploaded successfully.'),
                                    "subfolder" => $subfolder,
                                ]);
                            }catch(\Exception $e){
                                return response()->json([
                                    "done" => 0,
                                    "status" => false,
                                    "is_success" => false,
                                    "message" =>  __('Something went wrong.'),
                                    "subfolder" => $subfolder,
                                ]);
                            }
                        }else{
                            return redirect()->back()->with('error', __('Directory not found.'));
                        }
                    }else{
                        return redirect()->back()->with('error', __('Please upload valid file.'));
                    }
                }
            }else{
                return redirect()->back()->with('error', __('Product Not Found.'));
            }
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public static function dir_contents_recursive($dir) {
        // open handler for the directory
        $iter = new DirectoryIterator($dir);
        $data = [];
        $data1 = [];
        $default_icon = config('defaultIcon');

        foreach( $iter as $item ) {
            if ($item != '.' && $item != '..') {
                if( $item->isDir() ) {
                    $default_icon_image = !empty($default_icon['folder']) ? $default_icon['folder'] : 'folder.png';
                    $icon_file = url("assets/img/icons/files/".$default_icon_image);
                    $data[] = (object)['icon' => $icon_file, 'name' => $item->getFilename(), 'size' => self::formatBytes($item->getSize()), 'date' => Utility::getDateFormatted(Carbon::createFromTimestamp($item->getCTime())->toDateString()), 'path' => $item->getPathname(), 'exe' => "folder"];
                } else {
                    $fileextension = strtolower($item->getExtension());
                    $default_icon_image = !empty($default_icon[$fileextension]) ? $default_icon[$fileextension] : 'file.png';
                    $icon_file = url("assets/img/icons/files/".$default_icon_image);
                    $data1[] = (object)['icon' => $icon_file, 'name' => $item->getFilename(), 'size' => self::formatBytes($item->getSize()), 'date' => Utility::getDateFormatted(Carbon::createFromTimestamp($item->getCTime())->toDateString()), 'path' => $item->getPathname(), 'exe' => $item->getExtension()];
                }
            }
        }
        $date_data  = array_column($data, 'date');
        array_multisort($date_data, SORT_DESC, $data);
        $data = array_merge($data,$data1);
        return $data;
    }

    public static function formatBytes($bytes, $precision = 2)
	{
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function getDownload($fileName,$id,$exe = 'folder',$folder = '')
    {

        $product = Products::where(['id'    => $id])->first();

        if(!is_null($product)){

            if($folder != ''){
                $file = TenantFileAccess::getFilePath($product->product_version.'/'.$product->product_name.'/'.$folder.'/'.$fileName);
            }else{
                $file = TenantFileAccess::getFilePath($product->product_version.'/'.$product->product_name.'/'.$fileName);
            }

            if($file){
                if($exe != 'folder'){
                    File_download_history::create([
                        'tenant_id' => tenant('tenant_id'),
                        'product_id' => $product->id,
                        'filename' => $fileName,
                        'download_date' => date('Y-m-d H:i:s'),
                        'download_user_id' => Auth::user()->id
                    ]);
                    $headers = array('Content-Type: application/'.$exe);
                    return Response::download($file, $fileName, $headers);
                }else{
                    return abort(403, 'Unauthorized action.');
                }
            }else{
                return abort(404);
            }
        }else{
            return abort(403, 'Unauthorized action.');
        }
    }

    public function destroyFile(Request $request)
    {
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
        	//dd($request->filepath);
            $filePath = TenantFileAccess::directoryExists($request->filepath);
            if($filePath){
                if(is_dir($filePath)){
                    TenantFileAccess::rrmdir($filePath);
                }else{
                    unlink($filePath);
                }


                return response()->json([
                    'is_success' => true,
                    'message' => __('File deleted successfully.'),
                ]);
            }else{
                return response()->json([
                    'is_success' => false,
                    'message' => __('Directory or file does not found.'),
                ]);
            }
        }else{
            return response()->json([
                'is_success' => false,
                'message' => __('Permission Denied.'),
            ]);
        }
    }

    public function reports(){
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $tenant_list = Tenant::where('account_status',1)->orderBy('company_name')->get();
            $release_list = Products::select('product_version')->distinct()->get()->pluck('product_version')->toArray();
            return view('engage_downloadcenter::TenantFileAccess.Admin.reports',compact('tenant_list','release_list'));
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function reportsFilterData(Request $request){
        if (Auth::user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $data = [];
            $titles = [];
            $type = $request->type;
            if($request->type == "product"){
                $product_version = $request->release;
                $product = $request->product;

                if(!empty($product) && !empty($product_version)){
                    $data = Tenant::join('product_permissions', 'product_permissions.tenant_id', '=', 'tenants.tenant_id')
                    ->join('products', 'products.id', '=', 'product_permissions.product_id')
                    ->where(['products.product_version' => $product_version, 'products.id' => $product])
                    ->select('tenants.company_name as Tenant','tenants.tenant_id as Tenant ID')
                    ->get()->toArray();
                }


                $titles = [__('Tenant'), __('Tenant ID')];

            }elseif($request->type == "tenant"){
                $tenant = $request->tenant;
                if(!empty($tenant)){
                    $data = DB::select("SELECT product_version as 'Release', product_name as 'Product', last_download_date as 'Last Download' FROM products JOIN product_permissions ON products.id=product_permissions.product_id LEFT JOIN (SELECT tenant_id,product_id,MAX(download_date) as last_download_date FROM file_download_history WHERE tenant_id='$tenant' GROUP BY tenant_id,product_id)a ON a.tenant_id=product_permissions.tenant_id AND a.product_id=product_permissions.product_id WHERE product_permissions.tenant_id='$tenant'");
                }

                $titles = [__('Release'), __('Product'), __('Last Download')];

            }elseif($request->type == "date"){
                $date = $request->daterange;
                $date = explode(' - ', $date);
                if(count($date)>0){
                    $data = File_download_history::select('company_name', 'product_version', 'product_name', 'filename', 'download_date')
                    ->join('tenants','file_download_history.tenant_id','=','tenants.tenant_id')
                    ->join('products','file_download_history.product_id','=','products.id')
                    ->select('tenants.company_name as Tenant','products.product_version as Release','products.product_name as Product','file_download_history.filename as File name','file_download_history.download_date as Last Download');
                    if(!empty($date[0])){
                        $startdate = date_create($date[0]);
                        $data = $data->whereDate('download_date','>=',date_format($startdate,"Y-m-d"));
                    }
                    if(!empty($date[1])){
                        $enddate = date_create($date[1]);
                        $data = $data->whereDate('download_date','<=',date_format($enddate,"Y-m-d"));
                    }
                    $data = $data->get()->toArray();
                    $titles = [__('Tenant'), __('Release'), __('Product'), __('File name'), __('Last Download')];
                }
            }

            $printData = json_encode($data);
            $printGridTitle = json_encode($titles);
            return response()->json([
                'is_success' => true,
                'data' => view('engage_downloadcenter::TenantFileAccess.Admin.report_filter',compact('data','type','printData','printGridTitle'))->render(),
            ]);
        }else{

            return response()->json([
                'is_success' => false,
                'message' => __('Permission Denied.'),
            ]);
        }
    }

    /**
    * Saves the file
    *
    * @param UploadedFile $file
    *
    * @return JsonResponse
    */

    protected function saveFile(UploadedFile $file, $finalPath, $fileName, $subfolder) {
        $user_obj = auth()->user();

        // Get file mime type
        $mime_original = $file->getMimeType();
        $mime = str_replace('/', '-', $mime_original);

        // move the file name
        $file->move($finalPath, $fileName);

        return response()->json([
            'path' => $finalPath,
            'name' => $fileName,
            'mime_type' => $mime,
            'subfolder' => $subfolder,
            "is_success" => true,
            "message" =>  __('File uploaded successfully.'),
        ]);
    }
}
