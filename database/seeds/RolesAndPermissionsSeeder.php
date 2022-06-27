<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions dashboard
        Permission::create(['name' => 'cards dashboard']);
        Permission::create(['name' => 'variable charts dashboard']);
        Permission::create(['name' => 'result charts dashboard']);

        // create permissions users
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'store users']);
        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'destroy users']);

        // create permissions questionnaires
        Permission::create(['name' => 'questionnaires']);
        Permission::create(['name' => 'create questionnaires']);
        Permission::create(['name' => 'store questionnaires']);
        Permission::create(['name' => 'show questionnaires']);
        Permission::create(['name' => 'edit questionnaires']);
        Permission::create(['name' => 'update questionnaires']);
        Permission::create(['name' => 'destroy questionnaires']);
        Permission::create(['name' => 'assign questions']);
        Permission::create(['name' => 'assign answers']);


        // create permissions surveyresponses
        Permission::create(['name' => 'surveyresponses']);
        Permission::create(['name' => 'show surveyresponses']);
        Permission::create(['name' => 'show by user surveyresponses']);
        Permission::create(['name' => 'delete by user surveyresponses']);
        Permission::create(['name' => 'calculate surveyresponses']);

        // create permissions variables
        Permission::create(['name' => 'variables']);
        Permission::create(['name' => 'show variables']);
        Permission::create(['name' => 'evaluate variables']);
        Permission::create(['name' => 'export variables']);

        // create permissions results
        Permission::create(['name' => 'results']);
        Permission::create(['name' => 'show results']);
        Permission::create(['name' => 'export results']);

        // create permissions profiles
        Permission::create(['name' => 'profiles']);
        Permission::create(['name' => 'edit profiles']);
        Permission::create(['name' => 'update profiles']);
        Permission::create(['name' => 'show surveyresponse by profile']);

        // create permissions surveys
        Permission::create(['name' => 'surveys']);
        Permission::create(['name' => 'store surveys']);
        Permission::create(['name' => 'show surveys']);

        // create roles and assign created permissions

        // or may be done by chaining
        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'cards dashboard',
                'variable charts dashboard',
                'result charts dashboard',
                'profiles',
                'edit profiles',
                'update profiles',
                'users',
                'create users',
                'store users',
                'show users',
                'edit users',
                'update users',
                'destroy users',
                'questionnaires',
                'create questionnaires',
                'store questionnaires',
                'show questionnaires',
                'edit questionnaires',
                'update questionnaires',
                'destroy questionnaires',
                'assign questions',
                'assign answers',
                'surveys',
                'show surveys',
                'surveyresponses',
                'show surveyresponses',
                'show by user surveyresponses',
                'delete by user surveyresponses',
                'calculate surveyresponses',
                'variables',
                'show variables',
                'evaluate variables',
                'export variables',
                'results',
                'show results',
                'export results',
            ]);

        $role = Role::create(['name' => 'director'])
            ->givePermissionTo([
                'cards dashboard',
                'variable charts dashboard',
                'result charts dashboard',
                'profiles',
                'edit profiles',
                'update profiles',
                'surveyresponses',
                'show surveyresponses',
                'show by user surveyresponses',
                'calculate surveyresponses',
                'variables',
                'show variables',
                'evaluate variables',
                'export variables',
                'results',
                'show results',
                'export results',
            ]);

        $role = Role::create(['name' => 'user'])
            ->givePermissionTo([
                'profiles',
                'edit profiles',
                'update profiles',
                'show surveyresponse by profile',
                'surveys',
                'store surveys',
                'show surveys',
            ]);

        $role = Role::create(['name' => 'super admin']);
        $role->givePermissionTo(Permission::all());
    }
}
