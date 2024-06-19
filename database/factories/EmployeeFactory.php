<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\Company;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'date' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'area' => $this->faker->word,
            'category' => $this->faker->randomElement(['Empleado', 'Directivo', 'Contratista']),
            'company_id' => Company::factory(),
            'satisfaction_level' => $this->faker->numberBetween(0, 100),
        ];
    }
}
