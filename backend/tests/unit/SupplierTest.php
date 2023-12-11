<?php

namespace backend\tests\unit;

use app\models\Supplier;

class SupplierTest extends \Codeception\Test\Unit
{
    public function testSupplierValidation()
    {
        $supplier = new Supplier();

        // Test with valid data
        $supplier->setAttributes([
            'name' => 'Supplier ABC',
            'nif' => '123456789',
        ]);

        $this->assertTrue($supplier->validate(), 'Validation passed with valid data');

        // Test with missing required data
        $supplier->setAttributes([
            'name' => null,
            'nif' => null,
        ]);

        $this->assertFalse($supplier->validate(), 'Validation failed with missing required data');

        // Test with invalid data
        $supplier->setAttributes([
            'name' => str_repeat('a', 300),
            'nif' => 'Invalid NIF',
        ]);

        $this->assertFalse($supplier->validate(), 'Validation failed with invalid data');
    }

    public function testSupplierAttributes()
    {
        $supplier = new Supplier();

        // Test attribute assignments
        $supplier->name = 'Test Supplier';
        $supplier->nif = '987654321';

        $this->assertEquals('Test Supplier', $supplier->name, 'Name attribute assigned correctly');
        $this->assertEquals('987654321', $supplier->nif, 'NIF attribute assigned correctly');
    }

    public function testSupplierCRUD()
    {
        // Create a new supplier
        $supplier = new Supplier();
        $supplier->setAttributes([
            'name' => 'New Supplier',
            'nif' => '111222333',
        ]);

        $this->assertTrue($supplier->save(), 'Supplier saved successfully');

        // Read the supplier from the database
        $savedSupplier = Supplier::findOne($supplier->id);

        $this->assertNotNull($savedSupplier, 'Supplier found in the database');
        $this->assertEquals('New Supplier', $savedSupplier->name, 'Name is correct');
        $this->assertEquals('111222333', $savedSupplier->nif, 'NIF is correct');

        // Update the supplier
        $savedSupplier->name = 'Updated Supplier';
        $savedSupplier->save();

        // Read the updated supplier from the database
        $updatedSupplier = Supplier::findOne($savedSupplier->id);

        $this->assertEquals('Updated Supplier', $updatedSupplier->name, 'Supplier name updated successfully');

        // Delete the supplier
        $updatedSupplier->delete();

        // Try to find the deleted supplier
        $deletedSupplier = Supplier::findOne($updatedSupplier->id);

        $this->assertNull($deletedSupplier, 'Supplier deleted successfully');
    }
}
