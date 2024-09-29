class Car extends Model {
    public function rentals() {
        return $this->hasMany(Rental::class);
    }
}
