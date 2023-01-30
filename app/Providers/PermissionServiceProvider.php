use Spatie\Permission\Models\Permission;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        Permission::create(['name' => 'view-requisitions']);
        Permission::create(['name' => 'create-requisitions']);
    }
}
