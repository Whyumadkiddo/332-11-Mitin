using System;
using System.Collections.Generic;
using System.Windows.Forms;

namespace Students
{
    public partial class Form1 : Form
    {
        private string tempLastName;
        private string tempFirstName;
        private string tempMiddleName;
        private string tempCourse;
        private string tempGroup;
        private string tempBirthDate;
        private string tempEmail;

        private List<Student> students;
        private List<Student> originalStudents;
        private readonly StudentManager studentManager;

        public Form1()
        {
            InitializeComponent();
            studentManager = new StudentManager();
            students = studentManager.LoadStudents();
            originalStudents = new List<Student>(students);
            InitializeDataGridView();
        }

        private void InitializeDataGridView()
        {
            dataGridViewStudents.Columns.Add("Id", "ID");
            dataGridViewStudents.Columns.Add("LastName", "Фамилия");
            dataGridViewStudents.Columns.Add("FirstName", "Имя");
            dataGridViewStudents.Columns.Add("MiddleName", "Отчество");
            dataGridViewStudents.Columns.Add("Course", "Курс");
            dataGridViewStudents.Columns.Add("Group", "Группа");
            dataGridViewStudents.Columns.Add("BirthDate", "Дата рождения");
            dataGridViewStudents.Columns.Add("Email", "Электронная почта");

            foreach (var student in students)
            {
                dataGridViewStudents.Rows.Add(student.Id, student.LastName, student.FirstName, student.MiddleName, student.Course, student.Group, student.BirthDate, student.Email);
            }
        }

        private void buttonAddStudent_Click(object sender, EventArgs e)
        {
            ResetTempVariables();

            if (InputStudentData())
            {
                int newId = studentManager.GetNextId(students);
                Student newStudent = new Student
                {
                    Id = newId,
                    LastName = tempLastName,
                    FirstName = tempFirstName,
                    MiddleName = tempMiddleName,
                    Course = tempCourse,
                    Group = tempGroup,
                    BirthDate = tempBirthDate,
                    Email = tempEmail
                };
                students.Add(newStudent);
                dataGridViewStudents.Rows.Add(newId, tempLastName, tempFirstName, tempMiddleName, tempCourse, tempGroup, tempBirthDate, tempEmail);
                MessageBox.Show("Студент успешно добавлен.");
            }
        }

        private void buttonEditStudent_Click(object sender, EventArgs e)
        {
            string inputId = ShowInputDialog("Введите ID студента для редактирования:", "");
            if (int.TryParse(inputId, out int studentId))
            {
                Student studentToEdit = students.Find(s => s.Id == studentId);
                if (studentToEdit != null)
                {
                    SetTempVariables(studentToEdit);

                    if (InputStudentData())
                    {
                        UpdateStudent(studentToEdit);
                        UpdateDataGridView(studentId);
                        MessageBox.Show("Данные студента успешно обновлены.");
                    }
                }
                else
                {
                    MessageBox.Show("Студент с указанным ID не найден.");
                }
            }
            else
            {
                MessageBox.Show("Некорректный ID студента.");
            }
        }

        private void buttonSearch_Click(object sender, EventArgs e)
        {
            string lastName = textBoxSearch.Text.Trim();
            if (!string.IsNullOrEmpty(lastName))
            {
                dataGridViewStudents.Rows.Clear();
                foreach (var student in students)
                {
                    if (student.LastName.IndexOf(lastName, StringComparison.OrdinalIgnoreCase) >= 0)
                    {
                        dataGridViewStudents.Rows.Add(student.Id, student.LastName, student.FirstName, student.MiddleName, student.Course, student.Group, student.BirthDate, student.Email);
                    }
                }
            }
            else
            {
                MessageBox.Show("Введите фамилию для поиска.");
            }
        }

        private void buttonDeleteStudent_Click(object sender, EventArgs e)
        {
            if (dataGridViewStudents.SelectedRows.Count > 0)
            {
                int id = (int)dataGridViewStudents.SelectedRows[0].Cells["Id"].Value;
                students.RemoveAll(s => s.Id == id);
                dataGridViewStudents.Rows.Remove(dataGridViewStudents.SelectedRows[0]);
            }
            else
            {
                MessageBox.Show("Выберите студента для удаления.");
            }
        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (!studentManager.AreStudentsEqual(students, originalStudents))
            {
                DialogResult result = MessageBox.Show("Сохранить изменения перед закрытием?", "Сохранение изменений", MessageBoxButtons.YesNoCancel, MessageBoxIcon.Question);
                if (result == DialogResult.Yes)
                {
                    studentManager.SaveStudents(students);
                }
                else if (result == DialogResult.No)
                {
                    students = new List<Student>(originalStudents);
                    InitializeDataGridView();
                }
                else
                {
                    e.Cancel = true;
                }
            }
        }

        private bool InputStudentData()
        {
            tempLastName = ShowInputDialog("Введите фамилию:", tempLastName);
            if (string.IsNullOrWhiteSpace(tempLastName)) return false;

            tempFirstName = ShowInputDialog("Введите имя:", tempFirstName);
            if (string.IsNullOrWhiteSpace(tempFirstName)) return false;

            tempMiddleName = ShowInputDialog("Введите отчество:", tempMiddleName);
            if (string.IsNullOrWhiteSpace(tempMiddleName)) return false;

            tempCourse = ShowInputDialog("Введите курс:", tempCourse);
            if (string.IsNullOrWhiteSpace(tempCourse)) return false;

            tempGroup = ShowInputDialog("Введите группу:", tempGroup);
            if (string.IsNullOrWhiteSpace(tempGroup)) return false;

            tempBirthDate = ShowInputDialog("Введите дату рождения (DD.MM.YYYY):", tempBirthDate);
            if (!studentManager.IsValidBirthDate(tempBirthDate))
            {
                MessageBox.Show("Некорректный формат даты рождения. Формат: DD.MM.YYYY. Дата должна быть не раньше 01.01.1992 и не позже текущей даты.");
                return false;
            }

            tempEmail = ShowInputDialog("Введите электронную почту:", tempEmail);
            if (!studentManager.IsValidEmail(tempEmail))
            {
                MessageBox.Show("Некорректный формат электронной почты. Допустимые домены: gmail.com, yandex.com, icloud.com.");
                return false;
            }

            return true;
        }

        private string ShowInputDialog(string prompt, string defaultValue)
        {
            Form promptForm = new Form()
            {
                Width = 500,
                FormBorderStyle = FormBorderStyle.FixedDialog,
                StartPosition = FormStartPosition.CenterScreen,
                MinimizeBox = false,
                MaximizeBox = false
            };

            Label textLabel = new Label() { Left = 50, Top = 20, Width = 400, Text = prompt };
            TextBox textBox = new TextBox() { Left = 50, Top = 50, Width = 400, Text = defaultValue };
            Button confirmation = new Button() { Text = "Ok", Left = 350, Width = 100, Top = 80, DialogResult = DialogResult.OK };
            confirmation.Click += (sender, e) => { promptForm.Close(); };
            promptForm.Controls.Add(textBox);
            promptForm.Controls.Add(confirmation);
            promptForm.Controls.Add(textLabel);
            promptForm.AcceptButton = confirmation;

            return promptForm.ShowDialog() == DialogResult.OK ? textBox.Text : "";
        }

        private void ResetTempVariables()
        {
            tempLastName = tempFirstName = tempMiddleName = tempCourse = tempGroup = tempBirthDate = tempEmail = string.Empty;
        }

        private void SetTempVariables(Student student)
        {
            tempLastName = student.LastName;
            tempFirstName = student.FirstName;
            tempMiddleName = student.MiddleName;
            tempCourse = student.Course;
            tempGroup = student.Group;
            tempBirthDate = student.BirthDate;
            tempEmail = student.Email;
        }

        private void UpdateStudent(Student student)
        {
            student.LastName = tempLastName;
            student.FirstName = tempFirstName;
            student.MiddleName = tempMiddleName;
            student.Course = tempCourse;
            student.Group = tempGroup;
            student.BirthDate = tempBirthDate;
            student.Email = tempEmail;
        }

        private void UpdateDataGridView(int studentId)
        {
            foreach (DataGridViewRow row in dataGridViewStudents.Rows)
            {
                if ((int)row.Cells["Id"].Value == studentId)
                {
                    row.Cells["LastName"].Value = tempLastName;
                    row.Cells["FirstName"].Value = tempFirstName;
                    row.Cells["MiddleName"].Value = tempMiddleName;
                    row.Cells["Course"].Value = tempCourse;
                    row.Cells["Group"].Value = tempGroup;
                    row.Cells["BirthDate"].Value = tempBirthDate;
                    row.Cells["Email"].Value = tempEmail;
                    break;
                }
            }
        }
    }
}
