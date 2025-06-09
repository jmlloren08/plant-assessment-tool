import { useState } from "react";
import { router } from "@inertiajs/react";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import Swal from 'sweetalert2';
import { Pencil, Trash2 } from "lucide-react";

interface PlantMake {
  id: string;
  name: string;
  description?: string;
}

interface PlantModel {
  id: string;
  name: string;
  description?: string;
  make_id: string;
  make: PlantMake;
}

interface PlantSerialRange {
  id: string;
  prefix: string;
  description?: string;
  model_id: string;
  model: PlantModel;
}

interface PlantSerialNumber {
  id: string;
  serial_number: string;
  description?: string;
  serial_range_id: string;
  serial_range: PlantSerialRange;
}

interface PlantSerialNumberFormData {
  serial_number: string;
  description: string;
  serial_range_id: string;
  [key: string]: string; // Add index signature for Inertia compatibility
}

interface PlantSerialNumberManagerProps {
  plantSerialNumbers: PlantSerialNumber[];
  plantSerialRanges: PlantSerialRange[];
}

export default function PlantSerialNumberManager({ plantSerialNumbers, plantSerialRanges }: PlantSerialNumberManagerProps) {
  const [open, setOpen] = useState<boolean>(false);
  const [formData, setFormData] = useState<PlantSerialNumberFormData>({
    serial_number: "",
    description: "",
    serial_range_id: "",
  });
  const [editId, setEditId] = useState<string | null>(null);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (editId) {
      router.put(`/plant-management/serials/${editId}`, formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ serial_number: "", description: "", serial_range_id: "" });
          setEditId(null);
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Serial number updated successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          console.error('Update failed:', errors);
          const errorMessage = errors?.serial_number
            ? `Serial Number ${errors.serial_number}`
            : 'Failed to update serial number';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    } else {
      router.post("/plant-management/serials", formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ serial_number: "", description: "", serial_range_id: "" });
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Serial number created successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          console.error('Create failed:', errors);
          const errorMessage = errors?.serial_number
            ? `Serial Number ${errors.serial_number}`
            : 'Failed to create serial number';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    }
  };

  const handleEdit = (serialNumber: PlantSerialNumber) => {
    setFormData({
      serial_number: serialNumber.serial_number,
      description: serialNumber.description || "",
      serial_range_id: serialNumber.serial_range_id,
    });
    setEditId(serialNumber.id);
    setOpen(true);
  };

  const handleDelete = (id: string) => {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result: { isConfirmed: boolean }) => {
      if (result.isConfirmed) {
        router.delete(`/plant-management/serials/${id}`, {
          onSuccess: () => {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Serial number deleted successfully',
              timer: 2000,
            });
          },
          onError: (errors) => {
            console.error('Delete failed:', errors);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Failed to delete serial number'
            });
          },
        });
      }
    });
  };

  return (
    <div className="space-y-4">
      <div className="flex justify-between items-center">
        <h2 className="text-lg font-semibold">Serial Numbers</h2>
        <Dialog open={open} onOpenChange={setOpen}>
          <DialogTrigger asChild>
            <Button
              onClick={() => {
                setFormData({ serial_number: "", description: "", serial_range_id: "" });
                setEditId(null);
              }}
            >
              Add New Serial Number
            </Button>
          </DialogTrigger>
          <DialogContent aria-describedby="dialog-description">
            <DialogHeader>
              <DialogTitle>
                {editId ? "Edit Serial Number" : "Add New Serial Number"}
              </DialogTitle>
              <p id="dialog-description" className="text-sm text-muted-foreground">
                {editId ? "Update the details of this serial number." : "Create a new serial number by filling out the form below."}
              </p>
            </DialogHeader>
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="space-y-2">
                <Label htmlFor="serial_range_id">Serial Range</Label>
                <Select
                  value={formData.serial_range_id}
                  onValueChange={(value) => setFormData({ ...formData, serial_range_id: value })}
                  required
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Select a serial range" />
                  </SelectTrigger>
                  <SelectContent>
                    {plantSerialRanges.map((range) => (
                      <SelectItem key={range.id} value={range.id}>
                        {range.model.make.name} - {range.model.name} ({range.prefix})
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              <div className="space-y-2">
                <Label htmlFor="serial_number">Serial Number</Label>
                <Input
                  id="serial_number"
                  value={formData.serial_number}
                  onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                    setFormData({ ...formData, serial_number: e.target.value })
                  }
                  required
                />
              </div>
              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  value={formData.description}
                  onChange={(e: React.ChangeEvent<HTMLTextAreaElement>) =>
                    setFormData({ ...formData, description: e.target.value })
                  }
                />
              </div>
              <div className="flex justify-end gap-2">
                <Button type="button" variant="secondary" onClick={() => setOpen(false)}>
                  Cancel
                </Button>
                <Button type="submit">
                  {editId ? "Update" : "Create"}
                </Button>
              </div>
            </form>
          </DialogContent>
        </Dialog>
      </div>

      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Make</TableHead>
            <TableHead>Model</TableHead>
            <TableHead>Range Prefix</TableHead>
            <TableHead>Serial Number</TableHead>
            <TableHead>Description</TableHead>
            <TableHead className="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          {plantSerialNumbers.length === 0 ? (
            <TableRow>
              <TableCell colSpan={6} className="text-center text-muted-foreground">
                No serial numbers found.
              </TableCell>
            </TableRow>
          ) : (
            plantSerialNumbers.map((serialNumber) => (
              <TableRow key={serialNumber.id}>
                <TableCell>{serialNumber.serial_range.model.make.name}</TableCell>
                <TableCell>{serialNumber.serial_range.model.name}</TableCell>
                <TableCell>{serialNumber.serial_range.prefix}</TableCell>
                <TableCell>{serialNumber.serial_number}</TableCell>
                <TableCell className="truncate max-w-xs" title={serialNumber.description}>
                  {serialNumber.description}
                </TableCell>
                <TableCell className="text-right space-x-2">
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={() => handleEdit(serialNumber)}
                  >
                    <Pencil />
                  </Button>
                  <Button
                    variant="destructive"
                    size="sm"
                    onClick={() => handleDelete(serialNumber.id)}
                  >
                    <Trash2 />
                  </Button>
                </TableCell>
              </TableRow>
            ))
          )}
        </TableBody>
      </Table>
    </div>
  );
} 