namespace Students
{
    public class Student
    {
        public int Id { get; set; }
        public string LastName { get; set; }
        public string FirstName { get; set; }
        public string MiddleName { get; set; }
        public string Course { get; set; }
        public string Group { get; set; }
        public string BirthDate { get; set; }
        public string Email { get; set; }

        public override bool Equals(object obj)
        {
            if (obj == null || GetType() != obj.GetType())
                return false;

            Student other = (Student)obj;
            return Id == other.Id &&
                   LastName == other.LastName &&
                   FirstName == other.FirstName &&
                   MiddleName == other.MiddleName &&
                   Course == other.Course &&
                   Group == other.Group &&
                   BirthDate == other.BirthDate &&
                   Email == other.Email;
        }

        public override int GetHashCode()
        {
            unchecked
            {
                int hash = 17;
                hash = hash * 23 + Id.GetHashCode();
                hash = hash * 23 + (LastName?.GetHashCode() ?? 0);
                hash = hash * 23 + (FirstName?.GetHashCode() ?? 0);
                hash = hash * 23 + (MiddleName?.GetHashCode() ?? 0);
                hash = hash * 23 + (Course?.GetHashCode() ?? 0);
                hash = hash * 23 + (Group?.GetHashCode() ?? 0);
                hash = hash * 23 + (BirthDate?.GetHashCode() ?? 0);
                hash = hash * 23 + (Email?.GetHashCode() ?? 0);
                return hash;
            }
        }
    }
}
