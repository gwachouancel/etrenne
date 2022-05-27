<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password','role','permission_id','lastname','status','phone','token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Permission() {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    public function Company() {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function Supplier() {
        return $this->hasOne(Supplier::class, 'user_id', 'id');
    }

    public function getFullNameAttribute(){
        return $this->name.' '.$this->lastname;
    }

    public function getFilialeNameAttribute(){
        $company = $this->Company ?? null ; 
        $name = $company && $this->Company->Filiale ? $this->Company->Filiale->name : null;

        return $name;
    }

    public function getDirectionIdAttribute(){
        return $this->Company ? $this->Company->direction_id : null;
    }

    public function getFilialeIdAttribute(){
        return $this->Company ? $this->Company->filiale_id : null;
    }

    public function getFonctionAttribute(){
        return $this->Company ? $this->Company->fonction : null;
    }

    public function getCompanyNameAttribute(){
        return $this->Supplier ? $this->Supplier->company : null;
    }

    public function getCompanyAddressAttribute(){
        return $this->Supplier ? $this->Supplier->address : null;
    }

    public function getProductTypeAttribute(){
        return $this->Supplier ? $this->Supplier->product_type : null;
    }

    public function getRibAttribute(){
        return $this->Supplier ? $this->Supplier->rib : null;
    }

    public function getSupplierCountryAttribute(){
        return $this->Supplier ? $this->Supplier->country : null;
    }

    public function getSupplierAddressAttribute(){
        return $this->Supplier ? $this->Supplier->address : null;
    }

    public function getPermissionNameAttribute(){
        return $this->Permission ? $this->Permission->name : null;
    }

    public function hasMenu($menuCode = null){
        return $this->role == 'admin' || !in_array($menuCode, config('app.menus')) || in_array($menuCode, $this->Permission->MenusCodes);
    }
}
