class Rental extends Model {
    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
