<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_no' => $this->faker->unique()->randomNumber(6, true),
            'drn_no' => $this->faker->unique()->bothify('DRN-####'),
            'incomingDate' => $this->faker->date(),
            'payee' => $this->faker->name(),
            'particulars' => $this->faker->sentence(5),
            'program' => $this->faker->randomElement(['Program A', 'Program B', 'Program C']),
            'budget_controller' => $this->faker->name(),
            'gross_amount' => $this->faker->randomFloat(2, 1000, 50000),
            'final_amount_norsa' => $this->faker->randomFloat(2, 1000, 50000),
            'fund_cluster' => $this->faker->bothify('FC-###'),
            'appropriation' => $this->faker->bothify('APP-####'),
            'remarks' => $this->faker->sentence(),
            'orsNum' => $this->faker->bothify('ORS-####'),
            'outgoingDate' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Return to End User', 'For Approval', 'Sent to Accounting'])
        ];
    }
}
