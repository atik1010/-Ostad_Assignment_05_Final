class User extends Authenticatable {
    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isCustomer() {
        return $this->role === 'customer';
    }

    public function rentals() {
        return $this->hasMany(Rental::class);
    }
}
