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

interface PlantSerialRangeFormData {
  prefix: string;
  description: string;
  model_id: string;
  [key: string]: string; // Add index signature for Inertia compatibility
}

interface PlantSerialRangeManagerProps {
  plantSerialRanges: PlantSerialRange[];
  plantModels: PlantModel[];
}

export default function PlantSerialRangeManager({ plantSerialRanges, plantModels }: PlantSerialRangeManagerProps) {
  const [open, setOpen] = useState<boolean>(false);
  const [formData, setFormData] = useState<PlantSerialRangeFormData>({
    prefix: "",
    description: "",
    model_id: "",
  });
  const [editId, setEditId] = useState<string | null>(null);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (editId) {
      router.put(`/plant-management/ranges/${editId}`, formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ prefix: "", description: "", model_id: "" });
          setEditId(null);
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Serial range updated successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          console.error('Update failed:', errors);
          const errorMessage = errors?.prefix
            ? `Prefix ${errors.prefix}`
            : 'Failed to update serial range';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    } else {
      router.post("/plant-management/ranges", formData, {
        onSuccess: () => {
          setOpen(false);
          setFormData({ prefix: "", description: "", model_id: "" });
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Serial range created successfully',
            timer: 2000,
          });
        },
        onError: (errors) => {
          console.error('Create failed:', errors);
          const errorMessage = errors?.prefix
            ? `Prefix ${errors.prefix}`
            : 'Failed to create serial range';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
          });
        },
      });
    }
  };

  const handleEdit = (range: PlantSerialRange) => {
    setFormData({
      prefix: range.prefix,
      description: range.description || "",
      model_id: range.model_id,
    });
    setEditId(range.id);
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
        router.delete(`/plant-management/ranges/${id}`, {
          onSuccess: () => {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Serial range deleted successfully',
              timer: 2000,
            });
          },
          onError: (errors) => {
            console.error('Delete failed:', errors);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Failed to delete serial range'
            });
          },
        });
      }
    });
  };

  return (
    <div className="space-y-4">
      <div className="flex justify-between items-center">
        <h2 className="text-lg font-semibold">Serial Ranges</h2>
        <Dialog open={open} onOpenChange={setOpen}>
          <DialogTrigger asChild>
            <Button
              onClick={() => {
                setFormData({ prefix: "", description: "", model_id: "" });
                setEditId(null);
              }}
            >
              Add New Range
            </Button>
          </DialogTrigger>
          <DialogContent aria-describedby="dialog-description">
            <DialogHeader>
              <DialogTitle>
                {editId ? "Edit Serial Range" : "Add New Serial Range"}
              </DialogTitle>
              <p id="dialog-description" className="text-sm text-muted-foreground">
                {editId ? "Update the details of this serial range." : "Create a new serial range by filling out the form below."}
              </p>
            </DialogHeader>
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="space-y-2">
                <Label htmlFor="model_id">Model</Label>
                <Select
                  value={formData.model_id}
                  onValueChange={(value) => setFormData({ ...formData, model_id: value })}
                  required
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Select a model" />
                  </SelectTrigger>
                  <SelectContent>
                    {plantModels.map((model) => (
                      <SelectItem key={model.id} value={model.id}>
                        {model.make.name} - {model.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              <div className="space-y-2">
                <Label htmlFor="prefix">Prefix</Label>
                <Input
                  id="prefix"
                  value={formData.prefix}
                  onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                    setFormData({ ...formData, prefix: e.target.value })
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
            <TableHead>Prefix</TableHead>
            <TableHead>Description</TableHead>
            <TableHead className="text-right">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          {plantSerialRanges.length === 0 ? (
            <TableRow>
              <TableCell colSpan={5} className="text-center text-muted-foreground">
                No serial ranges found.
              </TableCell>
            </TableRow>
          ) : (
            plantSerialRanges.map((range) => (
              <TableRow key={range.id}>
                <TableCell>{range.model.make.name}</TableCell>
                <TableCell>{range.model.name}</TableCell>
                <TableCell>{range.prefix}</TableCell>
                <TableCell className="truncate max-w-xs" title={range.description}>
                  {range.description}
                </TableCell>
                <TableCell className="text-right space-x-2">
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={() => handleEdit(range)}
                  >
                    <Pencil />
                  </Button>
                  <Button
                    variant="destructive"
                    size="sm"
                    onClick={() => handleDelete(range.id)}
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